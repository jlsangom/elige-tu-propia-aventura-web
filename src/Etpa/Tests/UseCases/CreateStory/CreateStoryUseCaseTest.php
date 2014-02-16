<?php

namespace Etpa\Tests\UseCases\CreateStory;

use Etpa\Infraestructure\Persistence\Memory\StoryRepository;
use Etpa\Tests\Domain\NotAvailableStoryRepository;

class CreateStoryUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Etpa\UseCases\CreateStory\CreateStoryException
     */
    public function ifRepositoryIsNotAvailableAnExceptionShouldBeThrown()
    {
        $request = $this->buildRequest();
        $storyRepository = new NotAvailableStoryRepository();
        $this->executeRequest($storyRepository, $request);
        $this->assertNull(null);
    }

    /**
     * @test
     */
    public function itShouldReturnAValidIdForANewStory()
    {
        $request = $this->buildRequest();
        $storyRepository = new StoryRepository();
        $response = $this->executeRequest($storyRepository, $request);
        $this->assertSame(1, $response->story->getId());
    }

    /**
     * @param $storyRepository
     * @param $request
     * @return \Etpa\UseCases\CreateStory\CreateStoryResponse
     */
    private function executeRequest($storyRepository, $request)
    {
        $usecase = new \Etpa\UseCases\CreateStory\CreateStoryUseCase($storyRepository);
        $response = $usecase->createStory($request);
        return $response;
    }

    /**
     * @return \stdClass
     */
    private function buildRequest()
    {
        $request = new \stdClass();
        $request->title = '#title#';
        return $request;
    }
}