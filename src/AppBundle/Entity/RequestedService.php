<?php



/**
 * RequestedService
 */
class RequestedService
{
    /**
     * @var string
     */
    private $requestedServiceName;

    /**
     * @var string
     */
    private $requestedServiceCategory;

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $dateRequested = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $approvedStatus = '0';

    /**
     * @var string
     */
    private $approvedBy;

    /**
     * @var string
     */
    private $requestedServiceDescription;

    /**
     * @var integer
     */
    private $requestedServiceId;

    /**
     * @var \UserProfile
     */
    private $userRequested;


    /**
     * Set requestedServiceName
     *
     * @param string $requestedServiceName
     *
     * @return RequestedService
     */
    public function setRequestedServiceName($requestedServiceName)
    {
        $this->requestedServiceName = $requestedServiceName;

        return $this;
    }

    /**
     * Get requestedServiceName
     *
     * @return string
     */
    public function getRequestedServiceName()
    {
        return $this->requestedServiceName;
    }

    /**
     * Set requestedServiceCategory
     *
     * @param string $requestedServiceCategory
     *
     * @return RequestedService
     */
    public function setRequestedServiceCategory($requestedServiceCategory)
    {
        $this->requestedServiceCategory = $requestedServiceCategory;

        return $this;
    }

    /**
     * Get requestedServiceCategory
     *
     * @return string
     */
    public function getRequestedServiceCategory()
    {
        return $this->requestedServiceCategory;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return RequestedService
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
     * Set dateRequested
     *
     * @param \DateTime $dateRequested
     *
     * @return RequestedService
     */
    public function setDateRequested($dateRequested)
    {
        $this->dateRequested = $dateRequested;

        return $this;
    }

    /**
     * Get dateRequested
     *
     * @return \DateTime
     */
    public function getDateRequested()
    {
        return $this->dateRequested;
    }

    /**
     * Set approvedStatus
     *
     * @param boolean $approvedStatus
     *
     * @return RequestedService
     */
    public function setApprovedStatus($approvedStatus)
    {
        $this->approvedStatus = $approvedStatus;

        return $this;
    }

    /**
     * Get approvedStatus
     *
     * @return boolean
     */
    public function getApprovedStatus()
    {
        return $this->approvedStatus;
    }

    /**
     * Set approvedBy
     *
     * @param string $approvedBy
     *
     * @return RequestedService
     */
    public function setApprovedBy($approvedBy)
    {
        $this->approvedBy = $approvedBy;

        return $this;
    }

    /**
     * Get approvedBy
     *
     * @return string
     */
    public function getApprovedBy()
    {
        return $this->approvedBy;
    }

    /**
     * Set requestedServiceDescription
     *
     * @param string $requestedServiceDescription
     *
     * @return RequestedService
     */
    public function setRequestedServiceDescription($requestedServiceDescription)
    {
        $this->requestedServiceDescription = $requestedServiceDescription;

        return $this;
    }

    /**
     * Get requestedServiceDescription
     *
     * @return string
     */
    public function getRequestedServiceDescription()
    {
        return $this->requestedServiceDescription;
    }

    /**
     * Get requestedServiceId
     *
     * @return integer
     */
    public function getRequestedServiceId()
    {
        return $this->requestedServiceId;
    }

    /**
     * Set userRequested
     *
     * @param \UserProfile $userRequested
     *
     * @return RequestedService
     */
    public function setUserRequested(\UserProfile $userRequested = null)
    {
        $this->userRequested = $userRequested;

        return $this;
    }

    /**
     * Get userRequested
     *
     * @return \UserProfile
     */
    public function getUserRequested()
    {
        return $this->userRequested;
    }
}


