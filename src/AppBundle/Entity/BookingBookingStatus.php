<?php



/**
 * BookingBookingStatus
 */
class BookingBookingStatus
{
    /**
     * @var \DateTime
     */
    private $startTime;

    /**
     * @var \DateTime
     */
    private $endTime;

    /**
     * @var boolean
     */
    private $active;

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
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return BookingBookingStatus
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return BookingBookingStatus
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
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


