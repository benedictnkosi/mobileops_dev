<?php



/**
 * UserProfile
 */
class UserProfile
{
    /**
     * @var boolean
     */
    private $active = '1';

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $secondName;

    /**
     * @var string
     */
    private $surname;

    /**
     * @var string
     */
    private $gender;

    /**
     * @var \DateTime
     */
    private $dateCreated = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     */
    private $idNumberOrPassport;

    /**
     * @var string
     */
    private $phoneNumber;

    /**
     * @var string
     */
    private $personalNote;

    /**
     * @var integer
     */
    private $userProfileId;

    /**
     * @var \Address
     */
    private $address;


    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return UserProfile
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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return UserProfile
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set secondName
     *
     * @param string $secondName
     *
     * @return UserProfile
     */
    public function setSecondName($secondName)
    {
        $this->secondName = $secondName;

        return $this;
    }

    /**
     * Get secondName
     *
     * @return string
     */
    public function getSecondName()
    {
        return $this->secondName;
    }

    /**
     * Set surname
     *
     * @param string $surname
     *
     * @return UserProfile
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return UserProfile
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return UserProfile
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set idNumberOrPassport
     *
     * @param string $idNumberOrPassport
     *
     * @return UserProfile
     */
    public function setIdNumberOrPassport($idNumberOrPassport)
    {
        $this->idNumberOrPassport = $idNumberOrPassport;

        return $this;
    }

    /**
     * Get idNumberOrPassport
     *
     * @return string
     */
    public function getIdNumberOrPassport()
    {
        return $this->idNumberOrPassport;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return UserProfile
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set personalNote
     *
     * @param string $personalNote
     *
     * @return UserProfile
     */
    public function setPersonalNote($personalNote)
    {
        $this->personalNote = $personalNote;

        return $this;
    }

    /**
     * Get personalNote
     *
     * @return string
     */
    public function getPersonalNote()
    {
        return $this->personalNote;
    }

    /**
     * Get userProfileId
     *
     * @return integer
     */
    public function getUserProfileId()
    {
        return $this->userProfileId;
    }

    /**
     * Set address
     *
     * @param \Address $address
     *
     * @return UserProfile
     */
    public function setAddress(\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return \Address
     */
    public function getAddress()
    {
        return $this->address;
    }
}


