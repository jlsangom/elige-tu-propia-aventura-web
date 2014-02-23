<?php

namespace Etpa\Domain;

interface StoryRepository
{
    /**
     * @param  \Etpa\Domain\Story                              $story
     * @throws \Etpa\UseCases\CreateStory\CreateStoryException
     * @return \Etpa\Domain\Story
     */
    public function persist($story);

    /**
     * @return \Etpa\Domain\Story[]
     * @throws \Etpa\UseCases\Story\CouldNotFetchStoriesException
     */
    public function findAll();
}
