<?php



/**
 * User
 */
class User
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $passwordRetryCount = '0';

    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $password = 'default_password';

    /**
     * @var \DateTime
     */
    private $passwordLastChanged;

    /**
     * @var string
     */
    private $userUserAccountStatusId = 'ACCOUNT_NOT_VERIFIED';

    /**
     * @var \DateTime
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $userUserRole;

    /**
     * @var string
     */
    private $facebookNetworkId;

    /**
     * @var string
     */
    private $twitterNetworkId;

    /**
     * @var string
     */
    private $googleNetworkId;

    /**
     * @var integer
     */
    private $userProfileId;

    /**
     * @var integer
     */
    private $userId;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return User
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
     * Set passwordRetryCount
     *
     * @param integer $passwordRetryCount
     *
     * @return User
     */
    public function setPasswordRetryCount($passwordRetryCount)
    {
        $this->passwordRetryCount = $passwordRetryCount;
    
        return $this;
    }

    /**
     * Get passwordRetryCount
     *
     * @return integer
     */
    public function getPasswordRetryCount()
    {
        return $this->passwordRetryCount;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return User
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    
        return $this;
    }

    /**
     * Get emailAddress
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set passwordLastChanged
     *
     * @param \DateTime $passwordLastChanged
     *
     * @return User
     */
    public function setPasswordLastChanged($passwordLastChanged)
    {
        $this->passwordLastChanged = $passwordLastChanged;
    
        return $this;
    }

    /**
     * Get passwordLastChanged
     *
     * @return \DateTime
     */
    public function getPasswordLastChanged()
    {
        return $this->passwordLastChanged;
    }

    /**
     * Set userUserAccountStatusId
     *
     * @param string $userUserAccountStatusId
     *
     * @return User
     */
    public function setUserUserAccountStatusId($userUserAccountStatusId)
    {
        $this->userUserAccountStatusId = $userUserAccountStatusId;
    
        return $this;
    }

    /**
     * Get userUserAccountStatusId
     *
     * @return string
     */
    public function getUserUserAccountStatusId()
    {
        return $this->userUserAccountStatusId;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return User
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
     * Set userUserRole
     *
     * @param string $userUserRole
     *
     * @return User
     */
    public function setUserUserRole($userUserRole)
    {
        $this->userUserRole = $userUserRole;
    
        return $this;
    }

    /**
     * Get userUserRole
     *
     * @return string
     */
    public function getUserUserRole()
    {
        return $this->userUserRole;
    }

    /**
     * Set facebookNetworkId
     *
     * @param string $facebookNetworkId
     *
     * @return User
     */
    public function setFacebookNetworkId($facebookNetworkId)
    {
        $this->facebookNetworkId = $facebookNetworkId;
    
        return $this;
    }

    /**
     * Get facebookNetworkId
     *
     * @return string
     */
    public function getFacebookNetworkId()
    {
        return $this->facebookNetworkId;
    }

    /**
     * Set twitterNetworkId
     *
     * @param string $twitterNetworkId
     *
     * @return User
     */
    public function setTwitterNetworkId($twitterNetworkId)
    {
        $this->twitterNetworkId = $twitterNetworkId;
    
        return $this;
    }

    /**
     * Get twitterNetworkId
     *
     * @return string
     */
    public function getTwitterNetworkId()
    {
        return $this->twitterNetworkId;
    }

    /**
     * Set googleNetworkId
     *
     * @param string $googleNetworkId
     *
     * @return User
     */
    public function setGoogleNetworkId($googleNetworkId)
    {
        $this->googleNetworkId = $googleNetworkId;
    
        return $this;
    }

    /**
     * Get googleNetworkId
     *
     * @return string
     */
    public function getGoogleNetworkId()
    {
        return $this->googleNetworkId;
    }

    /**
     * Set userProfileId
     *
     * @param integer $userProfileId
     *
     * @return User
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
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }
}


