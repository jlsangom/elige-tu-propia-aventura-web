<?php

namespace Etpa\Domain;

interface StoryRepository
{
    /**
     * @param \Etpa\Domain\Story $story
     * @throws \Etpa\UseCases\CreateStory\CreateStoryException
     * @return \Etpa\Domain\Story
     */
    public function persist($story);
}