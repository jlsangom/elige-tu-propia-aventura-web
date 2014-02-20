<?php

namespace Etpa\Infraestructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;

class StoryRepository extends EntityRepository implements \Etpa\Domain\StoryRepository
{
    /**
     * @param  \Etpa\Domain\Story $story
     * @return \Etpa\Domain\Story
     */
    public function persist($story)
    {
        $this->_em->persist($story);
        $this->_em->flush();
    }
}
