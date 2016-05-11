<?php



/**
 * LogUserActivity
 */
class LogUserActivity
{
    /**
     * @var \DateTime
     */
    private $activityDate;

    /**
     * @var string
     */
    private $action;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $userActivity;


    /**
     * Set activityDate
     *
     * @param \DateTime $activityDate
     *
     * @return LogUserActivity
     */
    public function setActivityDate($activityDate)
    {
        $this->activityDate = $activityDate;
    
        return $this;
    }

    /**
     * Get activityDate
     *
     * @return \DateTime
     */
    public function getActivityDate()
    {
        return $this->activityDate;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return LogUserActivity
     */
    public function setAction($action)
    {
        $this->action = $action;
    
        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return LogUserActivity
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
     * Get userActivity
     *
     * @return integer
     */
    public function getUserActivity()
    {
        return $this->userActivity;
    }
}


