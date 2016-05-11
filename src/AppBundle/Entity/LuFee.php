<?php



/**
 * LuFee
 */
class LuFee
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var string
     */
    private $feeAmount;

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
     * @return LuFee
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
     * Set feeAmount
     *
     * @param string $feeAmount
     *
     * @return LuFee
     */
    public function setFeeAmount($feeAmount)
    {
        $this->feeAmount = $feeAmount;
    
        return $this;
    }

    /**
     * Get feeAmount
     *
     * @return string
     */
    public function getFeeAmount()
    {
        return $this->feeAmount;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return LuFee
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
     * @return LuFee
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


