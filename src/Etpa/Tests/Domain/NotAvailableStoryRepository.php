<?php

namespace Etpa\Tests\Domain;

use Etpa\UseCases\CreateStory\CreateStoryException;

class NotAvailableStoryRepository implements \Etpa\Domain\StoryRepository
{
    /**
     * @param  \Etpa\Domain\Story                              $story
     * @throws \Etpa\UseCases\CreateStory\CreateStoryException
     * @return \Etpa\Domain\Story
     */
    public function persist($story)
    {
        throw new CreateStoryException();
    }
}
