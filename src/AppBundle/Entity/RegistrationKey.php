<?php



/**
 * RegistrationKey
 */
class RegistrationKey
{
    /**
     * @var string
     */
    private $emailAddress;

    /**
     * @var string
     */
    private $uniqueKey;

    /**
     * @var integer
     */
    private $activated = '0';

    /**
     * @var integer
     */
    private $registrationKeysId;


    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return RegistrationKey
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
     * Set uniqueKey
     *
     * @param string $uniqueKey
     *
     * @return RegistrationKey
     */
    public function setUniqueKey($uniqueKey)
    {
        $this->uniqueKey = $uniqueKey;
    
        return $this;
    }

    /**
     * Get uniqueKey
     *
     * @return string
     */
    public function getUniqueKey()
    {
        return $this->uniqueKey;
    }

    /**
     * Set activated
     *
     * @param integer $activated
     *
     * @return RegistrationKey
     */
    public function setActivated($activated)
    {
        $this->activated = $activated;
    
        return $this;
    }

    /**
     * Get activated
     *
     * @return integer
     */
    public function getActivated()
    {
        return $this->activated;
    }

    /**
     * Get registrationKeysId
     *
     * @return integer
     */
    public function getRegistrationKeysId()
    {
        return $this->registrationKeysId;
    }
}


