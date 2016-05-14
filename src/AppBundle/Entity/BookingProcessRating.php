<?php



/**
 * BookingProcessRating
 */
class BookingProcessRating
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var boolean
     */
    private $rating = '0';

    /**
     * @var \DateTime
     */
    private $dateRated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $bookingProcessRatingId;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingProcessRating
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
     * Set rating
     *
     * @param boolean $rating
     *
     * @return BookingProcessRating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    
        return $this;
    }

    /**
     * Get rating
     *
     * @return boolean
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set dateRated
     *
     * @param \DateTime $dateRated
     *
     * @return BookingProcessRating
     */
    public function setDateRated($dateRated)
    {
        $this->dateRated = $dateRated;
    
        return $this;
    }

    /**
     * Get dateRated
     *
     * @return \DateTime
     */
    public function getDateRated()
    {
        return $this->dateRated;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return BookingProcessRating
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Get bookingProcessRatingId
     *
     * @return integer
     */
    public function getBookingProcessRatingId()
    {
        return $this->bookingProcessRatingId;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingProcessRating
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


