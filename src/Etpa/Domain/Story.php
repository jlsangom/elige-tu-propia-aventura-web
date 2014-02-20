<?php

namespace Etpa\Domain;

class Story
{
    use Validator;

    const TITLE_MAX_LENGTH = 250;
    const DESCRIPTION_MAX_LENGTH = 1500;

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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
        $this->assertStringLengthIsLessOrEqual($title, self::TITLE_MAX_LENGTH);
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
        $this->assertStringLengthIsLessOrEqual($description, self::DESCRIPTION_MAX_LENGTH);
        $this->description = $description;

        return $this;
    }
}
