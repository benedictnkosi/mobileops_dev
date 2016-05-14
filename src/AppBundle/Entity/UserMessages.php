<?php



/**
 * UserMessages
 */
class UserMessages
{
    /**
     * @var string
     */
    private $creationUserName;

    /**
     * @var string
     */
    private $creationUserSurname;

    /**
     * @var string
     */
    private $creationUserEmailAddress;

    /**
     * @var string
     */
    private $creationUserTelNumber;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $messageType;

    /**
     * @var integer
     */
    private $userMessageProfileId;

    /**
     * @var integer
     */
    private $userMessageId;


    /**
     * Set creationUserName
     *
     * @param string $creationUserName
     *
     * @return UserMessages
     */
    public function setCreationUserName($creationUserName)
    {
        $this->creationUserName = $creationUserName;
    
        return $this;
    }

    /**
     * Get creationUserName
     *
     * @return string
     */
    public function getCreationUserName()
    {
        return $this->creationUserName;
    }

    /**
     * Set creationUserSurname
     *
     * @param string $creationUserSurname
     *
     * @return UserMessages
     */
    public function setCreationUserSurname($creationUserSurname)
    {
        $this->creationUserSurname = $creationUserSurname;
    
        return $this;
    }

    /**
     * Get creationUserSurname
     *
     * @return string
     */
    public function getCreationUserSurname()
    {
        return $this->creationUserSurname;
    }

    /**
     * Set creationUserEmailAddress
     *
     * @param string $creationUserEmailAddress
     *
     * @return UserMessages
     */
    public function setCreationUserEmailAddress($creationUserEmailAddress)
    {
        $this->creationUserEmailAddress = $creationUserEmailAddress;
    
        return $this;
    }

    /**
     * Get creationUserEmailAddress
     *
     * @return string
     */
    public function getCreationUserEmailAddress()
    {
        return $this->creationUserEmailAddress;
    }

    /**
     * Set creationUserTelNumber
     *
     * @param string $creationUserTelNumber
     *
     * @return UserMessages
     */
    public function setCreationUserTelNumber($creationUserTelNumber)
    {
        $this->creationUserTelNumber = $creationUserTelNumber;
    
        return $this;
    }

    /**
     * Get creationUserTelNumber
     *
     * @return string
     */
    public function getCreationUserTelNumber()
    {
        return $this->creationUserTelNumber;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return UserMessages
     */
    public function setMessage($message)
    {
        $this->message = $message;
    
        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set messageType
     *
     * @param string $messageType
     *
     * @return UserMessages
     */
    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
    
        return $this;
    }

    /**
     * Get messageType
     *
     * @return string
     */
    public function getMessageType()
    {
        return $this->messageType;
    }

    /**
     * Set userMessageProfileId
     *
     * @param integer $userMessageProfileId
     *
     * @return UserMessages
     */
    public function setUserMessageProfileId($userMessageProfileId)
    {
        $this->userMessageProfileId = $userMessageProfileId;
    
        return $this;
    }

    /**
     * Get userMessageProfileId
     *
     * @return integer
     */
    public function getUserMessageProfileId()
    {
        return $this->userMessageProfileId;
    }

    /**
     * Get userMessageId
     *
     * @return integer
     */
    public function getUserMessageId()
    {
        return $this->userMessageId;
    }
}


