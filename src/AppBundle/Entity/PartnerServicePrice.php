<?php



/**
 * PartnerServicePrice
 */
class PartnerServicePrice
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
    private $userAdded;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $discountPercentage;

    /**
     * @var integer
     */
    private $partnerServicePriceId;

    /**
     * @var \PartnerService
     */
    private $partnerService;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return PartnerServicePrice
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
     * @return PartnerServicePrice
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
     * Set userAdded
     *
     * @param string $userAdded
     *
     * @return PartnerServicePrice
     */
    public function setUserAdded($userAdded)
    {
        $this->userAdded = $userAdded;

        return $this;
    }

    /**
     * Get userAdded
     *
     * @return string
     */
    public function getUserAdded()
    {
        return $this->userAdded;
    }

    /**
     * Set amount
     *
     * @param float $amount
     *
     * @return PartnerServicePrice
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set discountPercentage
     *
     * @param float $discountPercentage
     *
     * @return PartnerServicePrice
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    /**
     * Get discountPercentage
     *
     * @return float
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * Get partnerServicePriceId
     *
     * @return integer
     */
    public function getPartnerServicePriceId()
    {
        return $this->partnerServicePriceId;
    }

    /**
     * Set partnerService
     *
     * @param \PartnerService $partnerService
     *
     * @return PartnerServicePrice
     */
    public function setPartnerService(\PartnerService $partnerService = null)
    {
        $this->partnerService = $partnerService;

        return $this;
    }

    /**
     * Get partnerService
     *
     * @return \PartnerService
     */
    public function getPartnerService()
    {
        return $this->partnerService;
    }
}


