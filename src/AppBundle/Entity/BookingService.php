<?php



/**
 * BookingService
 */
class BookingService
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $partnerServiceId;

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
    private $bookingServiceId;

    /**
     * @var \Booking
     */
    private $booking;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingService
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
     * Set partnerServiceId
     *
     * @param integer $partnerServiceId
     *
     * @return BookingService
     */
    public function setPartnerServiceId($partnerServiceId)
    {
        $this->partnerServiceId = $partnerServiceId;

        return $this;
    }

    /**
     * Get partnerServiceId
     *
     * @return integer
     */
    public function getPartnerServiceId()
    {
        return $this->partnerServiceId;
    }

    /**
     * Set comments
     *
     * @param string $comments
     *
     * @return BookingService
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
     * @return BookingService
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
     * @return BookingService
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
     * @return BookingService
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
     * @return BookingService
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
     * @return BookingService
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
     * @return BookingService
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
     * @return BookingService
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
     * Get bookingServiceId
     *
     * @return integer
     */
    public function getBookingServiceId()
    {
        return $this->bookingServiceId;
    }

    /**
     * Set booking
     *
     * @param \Booking $booking
     *
     * @return BookingService
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


