<?php

use Etpa\Infraestructure\Persistence\Doctrine\EntityManagerFactory;
use Etpa\Tests\Infraestructure\Persistence\StoryRepository\EmptyStoryRepository;

require_once __DIR__.'/../../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;
$app['em'] = function() {
    return (new EntityManagerFactory())->build();
};

$app->get('/stories', function () use ($app) {
    $storyRepository = $app['em']->getRepository('Etpa\Domain\Story');
    $storyRepository = new EmptyStoryRepository();

    $usecase = new \Etpa\UseCases\Story\ViewStoriesUseCase($storyRepository);
    $response = $usecase->viewStories(new \Etpa\UseCases\Story\ViewStoriesRequest());

    return $app->escape(print_r($response->stories, 1));
});

$app->get('/page/{id}', function ($id) use ($app) {
    $pageRepository = $app['em']->getRepository('Etpa\Domain\Page');
    $usecase = new \Etpa\UseCases\Page\ViewPageUseCase($pageRepository);
    $response = $usecase->viewPage(new \Etpa\UseCases\Page\ViewPageRequest());

    return $app->escape(print_r($response->stories, 1));
});

$app->get('/story/add', function () use ($app) {
    $usecase = new \Etpa\UseCases\Story\ViewStoriesUseCase($app['em']->getRepository('Etpa\Domain\Story'));
    $response = $usecase->viewStories(new \Etpa\UseCases\Story\ViewPageRequest());

    return $app->escape(print_r($response->stories, 1));
});

$app->run();
