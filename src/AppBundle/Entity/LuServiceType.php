<?php



/**
 * LuServiceType
 */
class LuServiceType
{
    /**
     * @var integer
     */
    private $active;

    /**
     * @var string
     */
    private $name;


    /**
     * Set active
     *
     * @param integer $active
     *
     * @return LuServiceType
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
}


