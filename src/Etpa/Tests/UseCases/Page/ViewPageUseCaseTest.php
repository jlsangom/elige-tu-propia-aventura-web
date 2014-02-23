<?php

namespace Etpa\Tests\UseCases\Page;

use Etpa\Tests\Domain\NotAvailablePageRepository;
use Etpa\Tests\Infraestructure\Persistence\EmptyPageRepository;
use Etpa\UseCases\Page\ViewPageRequest;
use Etpa\UseCases\Page\ViewPageUseCase;

class ViewPageUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Etpa\UseCases\Page\PageDoesNotExistException
     */
    public function whenPageIdDoesNotExistInRepoShouldThrowAPageDoesNotExistException()
    {
        $pageRepository = new EmptyPageRepository();
        $usecase = new ViewPageUseCase($pageRepository);
        $request = new ViewPageRequest();
        $request->pageId = 1;
        $usecase->viewPage($request);
    }

    /**
     * @test
     * @expectedException \Etpa\UseCases\Page\PageRepositoryNotAvailableException
     */
    public function whenRepositoryNotAvailableShouldThrowAPageRepositoryNotAvailableException()
    {
        $pageRepository = new NotAvailablePageRepository();
        $usecase = new ViewPageUseCase($pageRepository);
        $request = new ViewPageRequest();
        $request->pageId = 1;
        $usecase->viewPage($request);
    }
}
