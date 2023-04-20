<?php

namespace BenBorla\JobAdder\V2\Model;

class PlacementRecruiterModel
{
    /**
     * @var int
     */
    protected $userId;
    /**
     * @var string
     */
    protected $firstName;
    /**
     * @var string
     */
    protected $lastName;
    /**
     * @var string
     */
    protected $jobTitle;
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $phone;
    /**
     * @var string
     */
    protected $mobile;
    /**
     * @var bool
     */
    protected $inactive;
    /**
     * @var bool
     */
    protected $deleted;
    /**
     * @var float
     */
    protected $feeSplit;

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     *
     * @return self
     */
    public function setUserId($userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return self
     */
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return self
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param string $jobTitle
     *
     * @return self
     */
    public function setJobTitle($jobTitle = null)
    {
        $this->jobTitle = $jobTitle;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return self
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param string $mobile
     *
     * @return self
     */
    public function setMobile($mobile = null)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * @return bool
     */
    public function getInactive()
    {
        return $this->inactive;
    }

    /**
     * @param bool $inactive
     *
     * @return self
     */
    public function setInactive($inactive = null)
    {
        $this->inactive = $inactive;

        return $this;
    }

    /**
     * @return bool
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @param bool $deleted
     *
     * @return self
     */
    public function setDeleted($deleted = null)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * @return float
     */
    public function getFeeSplit()
    {
        return $this->feeSplit;
    }

    /**
     * @param float $feeSplit
     *
     * @return self
     */
    public function setFeeSplit($feeSplit = null)
    {
        $this->feeSplit = $feeSplit;

        return $this;
    }
}
