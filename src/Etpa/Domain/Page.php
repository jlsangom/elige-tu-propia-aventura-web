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
     * @var Page
     */
    private $source;

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
     * @param \Etpa\Domain\Page $source
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return \Etpa\Domain\Page
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param Page $page
     * @return $this
     */
    public function addPage($page)
    {
        $this->pages[$page->getId()] = $page;
        $page->setSource($this);

        return $this;
    }

    /**
     * @return Page[]
     */
    public function getPages()
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
