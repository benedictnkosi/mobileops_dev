<?php



/**
 * LuUserRight
 */
class LuUserRight
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $addedBy;

    /**
     * @var string
     */
    private $name;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return LuUserRight
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return LuUserRight
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }

    /**
     * Set addedBy
     *
     * @param string $addedBy
     *
     * @return LuUserRight
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;

        return $this;
    }

    /**
     * Get addedBy
     *
     * @return string
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}


