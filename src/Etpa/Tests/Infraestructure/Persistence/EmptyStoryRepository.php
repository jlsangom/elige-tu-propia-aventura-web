<?php

namespace Etpa\Tests\Infraestructure\Persistence;

use Etpa\Domain\StoryRepository;

class EmptyStoryRepository implements StoryRepository
{
    /**
     * {@inheritDoc}
     */
    public function persist($story)
    {
        // TODO: Implement persist() method.
    }

    /**
     * {@inheritDoc}
     */
    public function findAll()
    {
        return [];
    }
}
