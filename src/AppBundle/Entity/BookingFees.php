<?php



/**
 * BookingFees
 */
class BookingFees
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $bookingFeeId;

    /**
     * @var \LuFee
     */
    private $fee;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingFees
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
     * @return BookingFees
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
     * Get bookingFeeId
     *
     * @return integer
     */
    public function getBookingFeeId()
    {
        return $this->bookingFeeId;
    }

    /**
     * Set fee
     *
     * @param \LuFee $fee
     *
     * @return BookingFees
     */
    public function setFee(\LuFee $fee = null)
    {
        $this->fee = $fee;
    
        return $this;
    }

    /**
     * Get fee
     *
     * @return \LuFee
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingFees
     */
    public function setBooking(\Booking $booking = null)
    {
        $this->booking = $booking;
    
        return $this;
    }

    /**
     * Get booking
     *
     * @return \Booking
     */
    public function getBooking()
    {
        return $this->booking;
    }
}


