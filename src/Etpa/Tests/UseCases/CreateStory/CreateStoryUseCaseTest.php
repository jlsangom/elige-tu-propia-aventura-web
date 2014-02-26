<?php

namespace Etpa\Tests\UseCases\CreateStory;

use Etpa\Tests\Infraestructure\Persistence\NotAvailableStoryRepository;

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
     * @atest
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
        return (new \Etpa\UseCases\CreateStory\CreateStoryUseCase($storyRepository))
            ->createStory($request);
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
