<?php



/**
 * RegionService
 */
class RegionService
{
    /**
     * @var boolean
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
     * @var integer
     */
    private $regionServiceId;

    /**
     * @var \LuService
     */
    private $service;

    /**
     * @var \LuRegion
     */
    private $region;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return RegionService
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
     * @return RegionService
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
     * @return RegionService
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
     * Get regionServiceId
     *
     * @return integer
     */
    public function getRegionServiceId()
    {
        return $this->regionServiceId;
    }

    /**
     * Set service
     *
     * @param \LuService $service
     *
     * @return RegionService
     */
    public function setService(\LuService $service = null)
    {
        $this->service = $service;
    
        return $this;
    }

    /**
     * Get service
     *
     * @return \LuService
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Set region
     *
     * @param \LuRegion $region
     *
     * @return RegionService
     */
    public function setRegion(\LuRegion $region = null)
    {
        $this->region = $region;
    
        return $this;
    }

    /**
     * Get region
     *
     * @return \LuRegion
     */
    public function getRegion()
    {
        return $this->region;
    }
}


