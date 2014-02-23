<?php

namespace Etpa\Tests\Infraestructure\Persistence\StoryRepository;

use Etpa\Domain\StoryRepository;

class EmptyStoryRepository implements StoryRepository
{
    /**
     * @param  \Etpa\Domain\Story $story
     * @throws \Etpa\UseCases\CreateStory\CreateStoryException
     * @return \Etpa\Domain\Story
     */
    public function persist($story)
    {
        // TODO: Implement persist() method.
    }

    /**
     * @return \Etpa\Domain\Story[]
     * @throws \Etpa\UseCases\Story\CouldNotFetchStoriesException
     */
    public function findAll()
    {
        return [];
    }
}
