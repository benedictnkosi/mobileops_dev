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
     * @var \DateTime
     */
    private $dateAdded = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $modifiedBy;

    /**
     * @var integer
     */
    private $userUserRightId;

    /**
     * @var \User
     */
    private $user;

    /**
     * @var \LuUserRight
     */
    private $userRight;


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

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return UserUserRight
     */
    public function setUser(\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set userRight
     *
     * @param \LuUserRight $userRight
     *
     * @return UserUserRight
     */
    public function setUserRight(\LuUserRight $userRight = null)
    {
        $this->userRight = $userRight;

        return $this;
    }

    /**
     * Get userRight
     *
     * @return \LuUserRight
     */
    public function getUserRight()
    {
        return $this->userRight;
    }
}


