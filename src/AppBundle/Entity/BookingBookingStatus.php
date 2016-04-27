<?php



/**
 * BookingBookingStatus
 */
class BookingBookingStatus
{
    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string
     */
    private $bookingBookingStatuscol;

    /**
     * @var \DateTime
     */
    private $timestamp = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $bookingBookingStatusId;

    /**
     * @var \Booking
     */
    private $booking;

    /**
     * @var \LuBookingStatus
     */
    private $bookingBookingStatus;


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
     * Set bookingBookingStatuscol
     *
     * @param string $bookingBookingStatuscol
     *
     * @return BookingBookingStatus
     */
    public function setBookingBookingStatuscol($bookingBookingStatuscol)
    {
        $this->bookingBookingStatuscol = $bookingBookingStatuscol;

        return $this;
    }

    /**
     * Get bookingBookingStatuscol
     *
     * @return string
     */
    public function getBookingBookingStatuscol()
    {
        return $this->bookingBookingStatuscol;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return BookingBookingStatus
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
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
}


