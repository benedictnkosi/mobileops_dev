<?php



/**
 * ServiceRemark
 */
class ServiceRemark
{
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
    private $remarkTypeId;

    /**
     * @var string
     */
    private $remark;

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $bookingServiceId;

    /**
     * @var integer
     */
    private $serviceRemarkId;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return ServiceRemark
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
     * @return ServiceRemark
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
     * Set remarkTypeId
     *
     * @param string $remarkTypeId
     *
     * @return ServiceRemark
     */
    public function setRemarkTypeId($remarkTypeId)
    {
        $this->remarkTypeId = $remarkTypeId;
    
        return $this;
    }

    /**
     * Get remarkTypeId
     *
     * @return string
     */
    public function getRemarkTypeId()
    {
        return $this->remarkTypeId;
    }

    /**
     * Set remark
     *
     * @param string $remark
     *
     * @return ServiceRemark
     */
    public function setRemark($remark)
    {
        $this->remark = $remark;
    
        return $this;
    }

    /**
     * Get remark
     *
     * @return string
     */
    public function getRemark()
    {
        return $this->remark;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return ServiceRemark
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
     * Set bookingServiceId
     *
     * @param integer $bookingServiceId
     *
     * @return ServiceRemark
     */
    public function setBookingServiceId($bookingServiceId)
    {
        $this->bookingServiceId = $bookingServiceId;
    
        return $this;
    }

    /**
     * Get bookingServiceId
     *
     * @return integer
     */
    public function getBookingServiceId()
    {
        return $this->bookingServiceId;
    }

    /**
     * Get serviceRemarkId
     *
     * @return integer
     */
    public function getServiceRemarkId()
    {
        return $this->serviceRemarkId;
    }
}


