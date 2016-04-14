<?php



/**
 * PartnerRating
 */
class PartnerRating
{
    /**
     * @var integer
     */
    private $rating;

    /**
     * @var \DateTime
     */
    private $dateAdded;

    /**
     * @var integer
     */
    private $partnerRatingId;

    /**
     * @var \User
     */
    private $user;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return PartnerRating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return PartnerRating
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
     * Get partnerRatingId
     *
     * @return integer
     */
    public function getPartnerRatingId()
    {
        return $this->partnerRatingId;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return PartnerRating
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
     * @return PartnerRating
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


