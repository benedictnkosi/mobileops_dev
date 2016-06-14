<?php



/**
 * UserMobility
 */
class UserMobility
{
    /**
     * @var integer
     */
    private $userProfileId;

    /**
     * @var string
     */
    private $userMobility;

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $userMobilityId;


    /**
     * Set userProfileId
     *
     * @param integer $userProfileId
     *
     * @return UserMobility
     */
    public function setUserProfileId($userProfileId)
    {
        $this->userProfileId = $userProfileId;

        return $this;
    }

    /**
     * Get userProfileId
     *
     * @return integer
     */
    public function getUserProfileId()
    {
        return $this->userProfileId;
    }

    /**
     * Set userMobility
     *
     * @param string $userMobility
     *
     * @return UserMobility
     */
    public function setUserMobility($userMobility)
    {
        $this->userMobility = $userMobility;

        return $this;
    }

    /**
     * Get userMobility
     *
     * @return string
     */
    public function getUserMobility()
    {
        return $this->userMobility;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return UserMobility
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
     * Set active
     *
     * @param boolean $active
     *
     * @return UserMobility
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
     * Get userMobilityId
     *
     * @return integer
     */
    public function getUserMobilityId()
    {
        return $this->userMobilityId;
    }
}


