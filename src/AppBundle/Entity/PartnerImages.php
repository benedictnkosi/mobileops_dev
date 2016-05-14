<?php



/**
 * PartnerImages
 */
class PartnerImages
{
    /**
     * @var integer
     */
    private $userId;

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
     * Set userId
     *
     * @param integer $userId
     *
     * @return PartnerImages
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
}


