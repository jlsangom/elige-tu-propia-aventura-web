<?php

namespace Etpa\UseCases\CreateStory;

class CreateStoryUseCase
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
     * @param CreateStoryRequest $request
     * @return \Etpa\UseCases\CreateStory\CreateStoryResponse
     * @throws CreateStoryException
     */
    public function createStory($request)
    {
        $story = new \Etpa\Domain\Story();
        $story->setTitle($request->title);
        $story->setDescription($request->description);
        $this->storyRepository->persist($story);
        try {
        } catch(\Exception $e) {
            throw new CreateStoryException();
        }

        $response = new CreateStoryResponse();
        $response->id = $story->getId();
        $response->story = $story;

        return $response;
    }
}