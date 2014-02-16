<?php

namespace Etpa\Infraestructure\Persistence\Memory;

class StoryRepository implements \Etpa\Domain\StoryRepository
{
    private $elements = [];

    /**
     * @param \Etpa\Domain\Story $story
     * @return \Etpa\Domain\Story
     */
    public function persist($story)
    {
        $id = $story->getId();
        if (null === $id) {
            $this->elements[] = $story;
            $story->setId(count($this->elements));
        } else {
            return $this->elements[$id - 1];
        }

        return $story;
    }
}