<?php



/**
 * BookingPartner
 */
class BookingPartner
{
    /**
     * @var integer
     */
    private $bookingId;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $bookingPartnerId;


    /**
     * Set bookingId
     *
     * @param integer $bookingId
     *
     * @return BookingPartner
     */
    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
    
        return $this;
    }

    /**
     * Get bookingId
     *
     * @return integer
     */
    public function getBookingId()
    {
        return $this->bookingId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return BookingPartner
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return BookingPartner
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
     * Get bookingPartnerId
     *
     * @return integer
     */
    public function getBookingPartnerId()
    {
        return $this->bookingPartnerId;
    }
}


