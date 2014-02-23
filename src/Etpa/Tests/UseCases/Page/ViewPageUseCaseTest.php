<?php

namespace Etpa\Tests\UseCases\Page;

use Etpa\Domain\Page;
use Etpa\Tests\Infraestructure\Persistence\NotAvailablePageRepository;
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
        $this->executeUseCase(new EmptyPageRepository());
    }

    /**
     * @test
     * @expectedException \Etpa\UseCases\Page\PageRepositoryNotAvailableException
     */
    public function whenRepositoryNotAvailableShouldThrowAPageRepositoryNotAvailableException()
    {
        $this->executeUseCase(new NotAvailablePageRepository());
    }

    /**
     * @test
     */
    public function whenPageIdDoesExistShouldReturnValidPage()
    {
        $page = (new Page())
            ->setId(1)
            ->setTitle('Title')
            ->setDescription('Description');

        $m = \Mockery::mock();
        $m->shouldReceive('find')->andReturn($page);

        $response = $this->executeUseCase($m);
        $this->assertsame($response->page, $page);
    }

    /**
     * @param $pageRepository
     * @return \Etpa\UseCases\Page\ViewPageResponse
     */
    private function executeUseCase($pageRepository)
    {
        $usecase = new ViewPageUseCase($pageRepository);
        $request = new ViewPageRequest();
        $request->pageId = 1;

        return $usecase->viewPage($request);
    }
}
