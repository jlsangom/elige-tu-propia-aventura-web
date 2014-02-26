<?php

namespace Etpa\Tests\UseCases\Story;

use Etpa\Tests\Infraestructure\Persistence\NotAvailableStoryRepository;
use Etpa\Tests\Infraestructure\Persistence\EmptyStoryRepository;
use Etpa\UseCases\Story\ViewStoriesRequest;
use Etpa\UseCases\Story\ViewStoriesUseCase;

class ViewStoriesUseCaseTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Etpa\UseCases\Story\StoryRepositoryNotAvailableException
     */
    public function whenRepositoryNotAvailableShouldThrowAStoryRepositoryNotAvailableException()
    {
        $this->executeUseCase(new NotAvailableStoryRepository());
    }

    /**
     * @test
     * @expectedException \Etpa\UseCases\Story\StoryRepositoryNotAvailableException
     */
    public function whenRepositoryIsEmptyShouldReturnEmptyList()
    {
        $this->executeUseCase(new EmptyStoryRepository());
    }

    /**
     * @param $storyRepository
     * @return \Etpa\UseCases\Story\ViewStoriesResponse
     */
    private function executeUseCase($storyRepository)
    {
        $usecase = new ViewStoriesUseCase($storyRepository);
        $request = new ViewStoriesRequest();

        return $usecase->viewStories($request);
    }
}
