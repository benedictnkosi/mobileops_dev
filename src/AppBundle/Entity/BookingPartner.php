<?php



/**
 * BookingPartner
 */
class BookingPartner
{
    /**
     * @var integer
     */
    private $bookingPartnerId;

    /**
     * @var \User
     */
    private $user;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Get bookingPartnerId
     *
     * @return integer
     */
    public function getBookingPartnerId()
    {
        return $this->bookingPartnerId;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return BookingPartner
     */
    public function setUser(\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingPartner
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


