<?php



/**
 * Address
 */
class Address
{
    /**
     * @var string
     */
    private $streetName;

    /**
     * @var integer
     */
    private $streetNumber;

    /**
     * @var string
     */
    private $suburbName;

    /**
     * @var string
     */
    private $cityName;

    /**
     * @var string
     */
    private $provinceName;

    /**
     * @var string
     */
    private $complexName;

    /**
     * @var string
     */
    private $latitude;

    /**
     * @var string
     */
    private $longitude;

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $addedBy;

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $addressId;


    /**
     * Set streetName
     *
     * @param string $streetName
     *
     * @return Address
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;

        return $this;
    }

    /**
     * Get streetName
     *
     * @return string
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set streetNumber
     *
     * @param integer $streetNumber
     *
     * @return Address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;

        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return integer
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set suburbName
     *
     * @param string $suburbName
     *
     * @return Address
     */
    public function setSuburbName($suburbName)
    {
        $this->suburbName = $suburbName;

        return $this;
    }

    /**
     * Get suburbName
     *
     * @return string
     */
    public function getSuburbName()
    {
        return $this->suburbName;
    }

    /**
     * Set cityName
     *
     * @param string $cityName
     *
     * @return Address
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;

        return $this;
    }

    /**
     * Get cityName
     *
     * @return string
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * Set provinceName
     *
     * @param string $provinceName
     *
     * @return Address
     */
    public function setProvinceName($provinceName)
    {
        $this->provinceName = $provinceName;

        return $this;
    }

    /**
     * Get provinceName
     *
     * @return string
     */
    public function getProvinceName()
    {
        return $this->provinceName;
    }

    /**
     * Set complexName
     *
     * @param string $complexName
     *
     * @return Address
     */
    public function setComplexName($complexName)
    {
        $this->complexName = $complexName;

        return $this;
    }

    /**
     * Get complexName
     *
     * @return string
     */
    public function getComplexName()
    {
        return $this->complexName;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Address
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Address
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return Address
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
     * Set addedBy
     *
     * @param string $addedBy
     *
     * @return Address
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Address
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
     * Get addressId
     *
     * @return integer
     */
    public function getAddressId()
    {
        return $this->addressId;
    }
}


