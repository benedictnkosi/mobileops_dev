<?php



/**
 * UserMobility
 */
class UserMobility
{
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
     * @var \UserProfile
     */
    private $userProfile;


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

    /**
     * Set userProfile
     *
     * @param \UserProfile $userProfile
     *
     * @return UserMobility
     */
    public function setUserProfile(\UserProfile $userProfile = null)
    {
        $this->userProfile = $userProfile;

        return $this;
    }

    /**
     * Get userProfile
     *
     * @return \UserProfile
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }
}


