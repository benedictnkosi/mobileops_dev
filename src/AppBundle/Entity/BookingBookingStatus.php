<?php



/**
 * BookingBookingStatus
 */
class BookingBookingStatus
{
    /**
     * @var \DateTime
     */
    private $dateChanged = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $active;

    /**
     * @var integer
     */
    private $bookingBookingStatusId;

    /**
     * @var \LuBookingStatus
     */
    private $bookingBookingStatus;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set dateChanged
     *
     * @param \DateTime $dateChanged
     *
     * @return BookingBookingStatus
     */
    public function setDateChanged($dateChanged)
    {
        $this->dateChanged = $dateChanged;
    
        return $this;
    }

    /**
     * Get dateChanged
     *
     * @return \DateTime
     */
    public function getDateChanged()
    {
        return $this->dateChanged;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingBookingStatus
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
     * Get bookingBookingStatusId
     *
     * @return integer
     */
    public function getBookingBookingStatusId()
    {
        return $this->bookingBookingStatusId;
    }

    /**
     * Set bookingBookingStatus
     *
     * @param \LuBookingStatus $bookingBookingStatus
     *
     * @return BookingBookingStatus
     */
    public function setBookingBookingStatus(\LuBookingStatus $bookingBookingStatus = null)
    {
        $this->bookingBookingStatus = $bookingBookingStatus;
    
        return $this;
    }

    /**
     * Get bookingBookingStatus
     *
     * @return \LuBookingStatus
     */
    public function getBookingBookingStatus()
    {
        return $this->bookingBookingStatus;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingBookingStatus
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


