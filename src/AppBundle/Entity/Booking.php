<?php



/**
 * Booking
 */
class Booking
{
    /**
     * @var boolean
     */
    private $active = '0';

    /**
     * @var \DateTime
     */
    private $timeBooked = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $userBooked;

    /**
     * @var string
     */
    private $bookingGuid;

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
     * Set userBooked
     *
     * @param string $userBooked
     *
     * @return Booking
     */
    public function setUserBooked($userBooked)
    {
        $this->userBooked = $userBooked;

        return $this;
    }

    /**
     * Get userBooked
     *
     * @return string
     */
    public function getUserBooked()
    {
        return $this->userBooked;
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


