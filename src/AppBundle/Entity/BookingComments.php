<?php



/**
 * BookingComments
 */
class BookingComments
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
     * @var string
     */
    private $bookingComments;

    /**
     * @var string
     */
    private $addedBy;

    /**
     * @var integer
     */
    private $bookingCommentsId;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingComments
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
     * @return BookingComments
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
     * Set bookingComments
     *
     * @param string $bookingComments
     *
     * @return BookingComments
     */
    public function setBookingComments($bookingComments)
    {
        $this->bookingComments = $bookingComments;
    
        return $this;
    }

    /**
     * Get bookingComments
     *
     * @return string
     */
    public function getBookingComments()
    {
        return $this->bookingComments;
    }

    /**
     * Set addedBy
     *
     * @param string $addedBy
     *
     * @return BookingComments
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
    
        return $this;
    }

    /**
     * Get addedBy
     *
     * @return string
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * Get bookingCommentsId
     *
     * @return integer
     */
    public function getBookingCommentsId()
    {
        return $this->bookingCommentsId;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingComments
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


