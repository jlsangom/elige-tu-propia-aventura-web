<?php

namespace Etpa\Domain;

class Page
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $description;

    /**
     * @var Page[]
     */
    private $pages = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *                      @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     *                            @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @param Page $page
     * @return $this
     */
    public function addPage($page)
    {
        $this->pages[$page->getId()] = $page;

        return $this;
    }

    /**
     * @return Page[]
     */
    public function getPageDestinations()
    {
        return $this->pages;
    }

    public function goToPage($id)
    {
        if (!isset($this->pages[$id])) {
            throw new NonExistingPageException();
        }

        return $this->pages[$id];
    }
}
