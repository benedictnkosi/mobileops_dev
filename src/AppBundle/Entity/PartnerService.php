<?php



/**
 * PartnerService
 */
class PartnerService
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
    private $partnerServiceId;

    /**
     * @var \LuService
     */
    private $service;

    /**
     * @var \UserProfile
     */
    private $partnerProfile;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return PartnerService
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
     * @return PartnerService
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
     * @return PartnerService
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
     * Get partnerServiceId
     *
     * @return integer
     */
    public function getPartnerServiceId()
    {
        return $this->partnerServiceId;
    }

    /**
     * Set service
     *
     * @param \LuService $service
     *
     * @return PartnerService
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
     * Set partnerProfile
     *
     * @param \UserProfile $partnerProfile
     *
     * @return PartnerService
     */
    public function setPartnerProfile(\UserProfile $partnerProfile = null)
    {
        $this->partnerProfile = $partnerProfile;

        return $this;
    }

    /**
     * Get partnerProfile
     *
     * @return \UserProfile
     */
    public function getPartnerProfile()
    {
        return $this->partnerProfile;
    }
}


