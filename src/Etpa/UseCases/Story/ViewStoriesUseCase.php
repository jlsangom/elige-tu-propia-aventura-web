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
     * @throws StoryRepositoryNotAvailableException
     * @return \Etpa\UseCases\Story\ViewStoriesResponse
     */
    public function viewStories($request)
    {
        $response = new ViewStoriesResponse();
        try {
            $response->stories = $this->storyRepository->findAll();
        } catch(\Exception $e) {
            throw new StoryRepositoryNotAvailableException();
        }

        return $response;
    }
}
