<?php



/**
 * LuService
 */
class LuService
{
    /**
     * @var string
     */
    private $serviceTypeName;

    /**
     * @var \DateTime
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var string
     */
    private $addedBy;

    /**
     * @var string
     */
    private $name;


    /**
     * Set serviceTypeName
     *
     * @param string $serviceTypeName
     *
     * @return LuService
     */
    public function setServiceTypeName($serviceTypeName)
    {
        $this->serviceTypeName = $serviceTypeName;
    
        return $this;
    }

    /**
     * Get serviceTypeName
     *
     * @return string
     */
    public function getServiceTypeName()
    {
        return $this->serviceTypeName;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return LuService
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    
        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return LuService
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
     * Set addedBy
     *
     * @param string $addedBy
     *
     * @return LuService
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


