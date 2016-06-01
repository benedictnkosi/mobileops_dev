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
    private $userActivity;

    /**
     * @var \User
     */
    private $user;


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
     * Get userActivity
     *
     * @return integer
     */
    public function getUserActivity()
    {
        return $this->userActivity;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return LogUserActivity
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
}


