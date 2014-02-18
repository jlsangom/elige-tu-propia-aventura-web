<?php

namespace Etpa\Domain;

interface PageRepository
{
    /**
     * @param \Etpa\Domain\Page $page
     * @throws \Etpa\UseCases\CreateStory\CreateStoryException
     * @return \Etpa\Domain\Story
     */
    public function persist($page);
}