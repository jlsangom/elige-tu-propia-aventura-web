<?php

namespace Etpa\UseCases\Story;

class ViewStoriesUseCase
{
    /**
     * @var \Etpa\Domain\StoryRepository
     */
    private $storyRepository;

    public function __construct($storyRepository)
    {
        $this->storyRepository = $storyRepository;
    }

    /**
     * @param $request
     * @return \Etpa\UseCases\Story\ViewStoriesResponse
     */
    public function viewStories($request)
    {
        $response = new ViewStoriesResponse();
        $response->stories = $this->storyRepository->findAll();

        return $response;
    }
}
