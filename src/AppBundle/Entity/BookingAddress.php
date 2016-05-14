<?php



/**
 * BookingAddress
 */
class BookingAddress
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $bookingAddressId;

    /**
     * @var \Address
     */
    private $clientAddress;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingAddress
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
     * Get bookingAddressId
     *
     * @return integer
     */
    public function getBookingAddressId()
    {
        return $this->bookingAddressId;
    }

    /**
     * Set clientAddress
     *
     * @param \Address $clientAddress
     *
     * @return BookingAddress
     */
    public function setClientAddress(\Address $clientAddress = null)
    {
        $this->clientAddress = $clientAddress;
    
        return $this;
    }

    /**
     * Get clientAddress
     *
     * @return \Address
     */
    public function getClientAddress()
    {
        return $this->clientAddress;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingAddress
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


