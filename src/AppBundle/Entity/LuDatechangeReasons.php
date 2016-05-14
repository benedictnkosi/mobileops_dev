<?php



/**
 * LuDatechangeReasons
 */
class LuDatechangeReasons
{
    /**
     * @var string
     */
    private $reason;

    /**
     * @var integer
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $reasonId;


    /**
     * Set reason
     *
     * @param string $reason
     *
     * @return LuDatechangeReasons
     */
    public function setReason($reason)
    {
        $this->reason = $reason;
    
        return $this;
    }

    /**
     * Get reason
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return LuDatechangeReasons
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return integer
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Get reasonId
     *
     * @return integer
     */
    public function getReasonId()
    {
        return $this->reasonId;
    }
}


