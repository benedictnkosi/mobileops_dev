<?php



/**
 * BookingSummaryView
 */
class BookingSummaryView
{
    /**
     * @var integer
     */
    private $bookingId = '0';

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var \DateTime
     */
    private $timeBooked;

    /**
     * @var string
     */
    private $mobileNumber;

    /**
     * @var string
     */
    private $userEmailAddress;

    /**
     * @var \DateTime
     */
    private $bookingStartTime;

    /**
     * @var \DateTime
     */
    private $bookingEndTime;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $addressId;

    /**
     * @var string
     */
    private $latestBookingStatus;

    /**
     * @var \DateTime
     */
    private $lastUpdated = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $bookingSummaryViewId;


    /**
     * Set bookingId
     *
     * @param integer $bookingId
     *
     * @return BookingSummaryView
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
     * Set active
     *
     * @param boolean $active
     *
     * @return BookingSummaryView
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
     * @return BookingSummaryView
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
     * Set mobileNumber
     *
     * @param string $mobileNumber
     *
     * @return BookingSummaryView
     */
    public function setMobileNumber($mobileNumber)
    {
        $this->mobileNumber = $mobileNumber;

        return $this;
    }

    /**
     * Get mobileNumber
     *
     * @return string
     */
    public function getMobileNumber()
    {
        return $this->mobileNumber;
    }

    /**
     * Set userEmailAddress
     *
     * @param string $userEmailAddress
     *
     * @return BookingSummaryView
     */
    public function setUserEmailAddress($userEmailAddress)
    {
        $this->userEmailAddress = $userEmailAddress;

        return $this;
    }

    /**
     * Get userEmailAddress
     *
     * @return string
     */
    public function getUserEmailAddress()
    {
        return $this->userEmailAddress;
    }

    /**
     * Set bookingStartTime
     *
     * @param \DateTime $bookingStartTime
     *
     * @return BookingSummaryView
     */
    public function setBookingStartTime($bookingStartTime)
    {
        $this->bookingStartTime = $bookingStartTime;

        return $this;
    }

    /**
     * Get bookingStartTime
     *
     * @return \DateTime
     */
    public function getBookingStartTime()
    {
        return $this->bookingStartTime;
    }

    /**
     * Set bookingEndTime
     *
     * @param \DateTime $bookingEndTime
     *
     * @return BookingSummaryView
     */
    public function setBookingEndTime($bookingEndTime)
    {
        $this->bookingEndTime = $bookingEndTime;

        return $this;
    }

    /**
     * Get bookingEndTime
     *
     * @return \DateTime
     */
    public function getBookingEndTime()
    {
        return $this->bookingEndTime;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return BookingSummaryView
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return BookingSummaryView
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set addressId
     *
     * @param string $addressId
     *
     * @return BookingSummaryView
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;

        return $this;
    }

    /**
     * Get addressId
     *
     * @return string
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * Set latestBookingStatus
     *
     * @param string $latestBookingStatus
     *
     * @return BookingSummaryView
     */
    public function setLatestBookingStatus($latestBookingStatus)
    {
        $this->latestBookingStatus = $latestBookingStatus;

        return $this;
    }

    /**
     * Get latestBookingStatus
     *
     * @return string
     */
    public function getLatestBookingStatus()
    {
        return $this->latestBookingStatus;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     *
     * @return BookingSummaryView
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * Get bookingSummaryViewId
     *
     * @return integer
     */
    public function getBookingSummaryViewId()
    {
        return $this->bookingSummaryViewId;
    }
}


