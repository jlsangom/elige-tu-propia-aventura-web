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
        $story = $this->tryToCreateStoryFromRequest($request);
        $this->tryToSaveStory($story);

        return $this->createResponse($story);
    }

    /**
     * @param $request
     * @return \Etpa\Domain\Story
     * @throws CreateStoryException
     */
    private function tryToCreateStoryFromRequest($request)
    {
        try {
            return $this->createStoryFromRequest($request);
        } catch (\Exception $e) {
            throw new CreateStoryException('There is some validation problem.');
        }
    }

    /**
     * @param $request
     * @return \Etpa\Domain\Story
     */
    private function createStoryFromRequest($request)
    {
        $story = new \Etpa\Domain\Story();
        $story->setTitle($request->title);
        $story->setDescription($request->description);

        return $story;
    }

    /**
     * @param $story
     * @throws CreateStoryException
     */
    private function tryToSaveStory($story)
    {
        try {
            $this->saveStory($story);
        } catch (\Exception $e) {
            throw new CreateStoryException();
        }
    }

    /**
     * @param $story
     */
    private function saveStory($story)
    {
        $this->storyRepository->persist($story);
    }

    /**
     * @param $story
     * @return CreateStoryResponse
     */
    private function createResponse($story)
    {
        $response = new CreateStoryResponse();
        $response->story = $story;

        return $response;
    }
}