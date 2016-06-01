<?php



/**
 * PartnerImages
 */
class PartnerImages
{
    /**
     * @var string
     */
    private $imageName;

    /**
     * @var integer
     */
    private $active = '1';

    /**
     * @var integer
     */
    private $imageId;

    /**
     * @var \User
     */
    private $user;


    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return PartnerImages
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set active
     *
     * @param integer $active
     *
     * @return PartnerImages
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
     * Get imageId
     *
     * @return integer
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * Set user
     *
     * @param \User $user
     *
     * @return PartnerImages
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


