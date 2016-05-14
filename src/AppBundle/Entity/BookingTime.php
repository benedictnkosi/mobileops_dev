<?php



/**
 * BookingTime
 */
class BookingTime
{
    /**
     * @var \DateTime
     */
    private $bookingStartTime;

    /**
     * @var \DateTime
     */
    private $bookingEndTime;

    /**
     * @var string
     */
    private $bookingLastChangeUser;

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var string
     */
    private $bookingReference;

    /**
     * @var integer
     */
    private $bookingTimeId;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set bookingStartTime
     *
     * @param \DateTime $bookingStartTime
     *
     * @return BookingTime
     */
    public function setBookingStartTime($bookingStartTime)
    {
        $this->bookingStartTime = $bookingStartTime;
    
        return $this;
    }

    /**
     * Get bookingStartTime
     *
     * @return \DateTime
     */
    public function getBookingStartTime()
    {
        return $this->bookingStartTime;
    }

    /**
     * Set bookingEndTime
     *
     * @param \DateTime $bookingEndTime
     *
     * @return BookingTime
     */
    public function setBookingEndTime($bookingEndTime)
    {
        $this->bookingEndTime = $bookingEndTime;
    
        return $this;
    }

    /**
     * Get bookingEndTime
     *
     * @return \DateTime
     */
    public function getBookingEndTime()
    {
        return $this->bookingEndTime;
    }

    /**
     * Set bookingLastChangeUser
     *
     * @param string $bookingLastChangeUser
     *
     * @return BookingTime
     */
    public function setBookingLastChangeUser($bookingLastChangeUser)
    {
        $this->bookingLastChangeUser = $bookingLastChangeUser;
    
        return $this;
    }

    /**
     * Get bookingLastChangeUser
     *
     * @return string
     */
    public function getBookingLastChangeUser()
    {
        return $this->bookingLastChangeUser;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingTime
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
     * Set bookingReference
     *
     * @param string $bookingReference
     *
     * @return BookingTime
     */
    public function setBookingReference($bookingReference)
    {
        $this->bookingReference = $bookingReference;
    
        return $this;
    }

    /**
     * Get bookingReference
     *
     * @return string
     */
    public function getBookingReference()
    {
        return $this->bookingReference;
    }

    /**
     * Get bookingTimeId
     *
     * @return integer
     */
    public function getBookingTimeId()
    {
        return $this->bookingTimeId;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingTime
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


