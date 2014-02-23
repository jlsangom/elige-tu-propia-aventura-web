<?php

use Etpa\Infraestructure\Persistence\Doctrine\EntityManagerFactory;

$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

require_once __DIR__.'/../../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app['em'] = function() {
    return (new EntityManagerFactory())->build();
};

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

$app->get('/stories', function () use ($app) {
    $request = new \Etpa\UseCases\Story\ViewStoriesRequest();

    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');
    $usecase = new \Etpa\UseCases\Story\ViewStoriesUseCase($storyRepository);
    $response = $usecase->viewStories($request);

    return $app->escape(print_r($response->stories, 1));
});

$app->get('/page/{id}', function ($id) use ($app) {
    $request = new \Etpa\UseCases\Page\ViewPageRequest();
    $request->pageId = $id;

    $pageRepository = $app['em']->getRepository('Etpa\Domain\Page');
    $usecase = new \Etpa\UseCases\Page\ViewPageUseCase($pageRepository);
    $response = $usecase->viewPage($request);

    return $app['twig']->render('view-page.html.twig', ['response' => $response]);
});

$app->get('/story/add', function () use ($app) {
    $usecase = new \Etpa\UseCases\Story\ViewStoriesUseCase($app['em']->getRepository('Etpa\Domain\Story'));
    $response = $usecase->viewStories(new \Etpa\UseCases\Story\ViewPageRequest());

    return $app->escape(print_r($response->stories, 1));
});

$app->get('/reset', function () use ($app) {
    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');
    $story = new \Etpa\Domain\Story();
    $story->setTitle('El laberinto');
    $story->setDescription('Un laberinto sin fin del que tendrás que salir, si puedes.');
    $storyRepository->persist($story);

    $pageRepository = $app['em']->getRepository('Etpa\Domain\Page');
    $page = new \Etpa\Domain\Page();
    $page->setTitle('Inicio y fin');
    $page->setDescription('Es una historia que tiene inicio y fin.');
    $pageRepository->persist($page);

    return $app->escape('Done!');
});

$app->run();
