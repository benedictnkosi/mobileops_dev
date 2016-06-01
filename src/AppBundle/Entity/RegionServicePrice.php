<?php



/**
 * RegionServicePrice
 */
class RegionServicePrice
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
    private $regionServicePriceId;

    /**
     * @var \RegionService
     */
    private $regionService;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return RegionServicePrice
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
     * @return RegionServicePrice
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
     * @return RegionServicePrice
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
     * @return RegionServicePrice
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
     * @return RegionServicePrice
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
     * Get regionServicePriceId
     *
     * @return integer
     */
    public function getRegionServicePriceId()
    {
        return $this->regionServicePriceId;
    }

    /**
     * Set regionService
     *
     * @param \RegionService $regionService
     *
     * @return RegionServicePrice
     */
    public function setRegionService(\RegionService $regionService = null)
    {
        $this->regionService = $regionService;

        return $this;
    }

    /**
     * Get regionService
     *
     * @return \RegionService
     */
    public function getRegionService()
    {
        return $this->regionService;
    }
}


