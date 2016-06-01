<?php



/**
 * LuServiceType
 */
class LuServiceType
{
    /**
     * @var integer
     */
    private $active;

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
     * @param integer $active
     *
     * @return LuServiceType
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer
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
     * @return LuServiceType
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
     * @return LuServiceType
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


