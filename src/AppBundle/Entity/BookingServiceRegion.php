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
     * @var integer
     */
    private $regionServiceId;

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
     * @var float
     */
    private $serviceAmount = '0';

    /**
     * @var float
     */
    private $discountPercentage = '0';

    /**
     * @var float
     */
    private $actualAmountToPay = '0';

    /**
     * @var string
     */
    private $serviceName;

    /**
     * @var string
     */
    private $serviceType;

    /**
     * @var integer
     */
    private $bookingServiceRegionId;

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
     * Set regionServiceId
     *
     * @param integer $regionServiceId
     *
     * @return BookingServiceRegion
     */
    public function setRegionServiceId($regionServiceId)
    {
        $this->regionServiceId = $regionServiceId;

        return $this;
    }

    /**
     * Get regionServiceId
     *
     * @return integer
     */
    public function getRegionServiceId()
    {
        return $this->regionServiceId;
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
     * Set serviceAmount
     *
     * @param float $serviceAmount
     *
     * @return BookingServiceRegion
     */
    public function setServiceAmount($serviceAmount)
    {
        $this->serviceAmount = $serviceAmount;

        return $this;
    }

    /**
     * Get serviceAmount
     *
     * @return float
     */
    public function getServiceAmount()
    {
        return $this->serviceAmount;
    }

    /**
     * Set discountPercentage
     *
     * @param float $discountPercentage
     *
     * @return BookingServiceRegion
     */
    public function setDiscountPercentage($discountPercentage)
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    /**
     * Get discountPercentage
     *
     * @return float
     */
    public function getDiscountPercentage()
    {
        return $this->discountPercentage;
    }

    /**
     * Set actualAmountToPay
     *
     * @param float $actualAmountToPay
     *
     * @return BookingServiceRegion
     */
    public function setActualAmountToPay($actualAmountToPay)
    {
        $this->actualAmountToPay = $actualAmountToPay;

        return $this;
    }

    /**
     * Get actualAmountToPay
     *
     * @return float
     */
    public function getActualAmountToPay()
    {
        return $this->actualAmountToPay;
    }

    /**
     * Set serviceName
     *
     * @param string $serviceName
     *
     * @return BookingServiceRegion
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;

        return $this;
    }

    /**
     * Get serviceName
     *
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * Set serviceType
     *
     * @param string $serviceType
     *
     * @return BookingServiceRegion
     */
    public function setServiceType($serviceType)
    {
        $this->serviceType = $serviceType;

        return $this;
    }

    /**
     * Get serviceType
     *
     * @return string
     */
    public function getServiceType()
    {
        return $this->serviceType;
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


