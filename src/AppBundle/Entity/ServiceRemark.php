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
    private $remark;

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $serviceRemarkId;

    /**
     * @var \LuRemark
     */
    private $remarkType;

    /**
     * @var \BookingServiceRegion
     */
    private $bookingService;


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
     * Get serviceRemarkId
     *
     * @return integer
     */
    public function getServiceRemarkId()
    {
        return $this->serviceRemarkId;
    }

    /**
     * Set remarkType
     *
     * @param \LuRemark $remarkType
     *
     * @return ServiceRemark
     */
    public function setRemarkType(\LuRemark $remarkType = null)
    {
        $this->remarkType = $remarkType;

        return $this;
    }

    /**
     * Get remarkType
     *
     * @return \LuRemark
     */
    public function getRemarkType()
    {
        return $this->remarkType;
    }

    /**
     * Set bookingService
     *
     * @param \BookingServiceRegion $bookingService
     *
     * @return ServiceRemark
     */
    public function setBookingService(\BookingServiceRegion $bookingService = null)
    {
        $this->bookingService = $bookingService;

        return $this;
    }

    /**
     * Get bookingService
     *
     * @return \BookingServiceRegion
     */
    public function getBookingService()
    {
        return $this->bookingService;
    }
}


