<?php

namespace Etpa\UseCases\Story;

class ViewStoryUseCase
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
     * @return \Etpa\UseCases\Story\ViewStoryResponse
     */
    public function viewStory($request)
    {
        $response = new ViewStoryResponse();
        $response->stories = $this->storyRepository->findAll();

        return $response;
    }
}
