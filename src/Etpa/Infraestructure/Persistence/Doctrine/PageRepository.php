<?php

namespace Etpa\Infraestructure\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;

class PageRepository extends EntityRepository implements \Etpa\Domain\PageRepository
{
    /**
     * @param \Etpa\Domain\Page $page
     * @return \Etpa\Domain\Page
     */
    public function persist($page)
    {
        $this->_em->persist($page);
        $this->_em->flush();
    }
}