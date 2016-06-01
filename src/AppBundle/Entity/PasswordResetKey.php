<?php



/**
 * PasswordResetKey
 */
class PasswordResetKey
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
    private $passwordResetKeyId;


    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     *
     * @return PasswordResetKey
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
     * @return PasswordResetKey
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
     * @return PasswordResetKey
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
     * Get passwordResetKeyId
     *
     * @return integer
     */
    public function getPasswordResetKeyId()
    {
        return $this->passwordResetKeyId;
    }
}


