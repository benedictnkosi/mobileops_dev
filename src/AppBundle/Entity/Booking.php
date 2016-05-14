<?php



/**
 * Booking
 */
class Booking
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $timeBooked = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $bookingGuid;

    /**
     * @var string
     */
    private $bookingReference;

    /**
     * @var integer
     */
    private $bookingId;

    /**
     * @var \User
     */
    private $user;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Booking
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
     * Set timeBooked
     *
     * @param \DateTime $timeBooked
     *
     * @return Booking
     */
    public function setTimeBooked($timeBooked)
    {
        $this->timeBooked = $timeBooked;
    
        return $this;
    }

    /**
     * Get timeBooked
     *
     * @return \DateTime
     */
    public function getTimeBooked()
    {
        return $this->timeBooked;
    }

    /**
     * Set bookingGuid
     *
     * @param string $bookingGuid
     *
     * @return Booking
     */
    public function setBookingGuid($bookingGuid)
    {
        $this->bookingGuid = $bookingGuid;
    
        return $this;
    }

    /**
     * Get bookingGuid
     *
     * @return string
     */
    public function getBookingGuid()
    {
        return $this->bookingGuid;
    }

    /**
     * Set bookingReference
     *
     * @param string $bookingReference
     *
     * @return Booking
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
     * Get bookingId
     *
     * @return integer
     */
    public function getBookingId()
    {
        return $this->bookingId;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return Booking
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
}


