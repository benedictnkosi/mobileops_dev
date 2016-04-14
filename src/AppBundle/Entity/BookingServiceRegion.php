<?php



/**
 * BookingServiceRegion
 */
class BookingServiceRegion
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var string
     */
    private $comments;

    /**
     * @var boolean
     */
    private $rating;

    /**
     * @var \DateTime
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $bookingServiceRegionId;

    /**
     * @var \RegionService
     */
    private $regionService;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingServiceRegion
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
     * Set comments
     *
     * @param string $comments
     *
     * @return BookingServiceRegion
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set rating
     *
     * @param boolean $rating
     *
     * @return BookingServiceRegion
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
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return BookingServiceRegion
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Get bookingServiceRegionId
     *
     * @return integer
     */
    public function getBookingServiceRegionId()
    {
        return $this->bookingServiceRegionId;
    }

    /**
     * Set regionService
     *
     * @param \RegionService $regionService
     *
     * @return BookingServiceRegion
     */
    public function setRegionService(\RegionService $regionService = null)
    {
        $this->regionService = $regionService;

        return $this;
    }

    /**
     * Get regionService
     *
     * @return \RegionService
     */
    public function getRegionService()
    {
        return $this->regionService;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingServiceRegion
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


