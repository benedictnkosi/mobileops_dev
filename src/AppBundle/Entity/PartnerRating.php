<?php



/**
 * PartnerRating
 */
class PartnerRating
{
    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $rating;

    /**
     * @var integer
     */
    private $bookingId;

    /**
     * @var \DateTime
     */
    private $dateAdded;

    /**
     * @var integer
     */
    private $partnerRatingId;


    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return PartnerRating
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
     * Set bookingId
     *
     * @param integer $bookingId
     *
     * @return PartnerRating
     */
    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
    
        return $this;
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
}


