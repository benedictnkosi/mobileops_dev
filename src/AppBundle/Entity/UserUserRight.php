<?php



/**
 * UserUserRight
 */
class UserUserRight
{
    /**
     * @var boolean
     */
    private $active;

    /**
     * @var string
     */
    private $userRightId;

    /**
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var string
     */
    private $modifiedBy;

    /**
     * @var integer
     */
    private $userUserRightId;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return UserUserRight
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
     * Set userRightId
     *
     * @param string $userRightId
     *
     * @return UserUserRight
     */
    public function setUserRightId($userRightId)
    {
        $this->userRightId = $userRightId;
    
        return $this;
    }

    /**
     * Get userRightId
     *
     * @return string
     */
    public function getUserRightId()
    {
        return $this->userRightId;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     *
     * @return UserUserRight
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return UserUserRight
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
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

    /**
     * Set modifiedBy
     *
     * @param string $modifiedBy
     *
     * @return UserUserRight
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
    
        return $this;
    }

    /**
     * Get modifiedBy
     *
     * @return string
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * Get userUserRightId
     *
     * @return integer
     */
    public function getUserUserRightId()
    {
        return $this->userUserRightId;
    }
}


