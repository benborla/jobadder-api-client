<?php

namespace Varspool\JobAdder\V2\Model;

class CompanyRepresentation
{
    /**
     * @var int
     */
    protected $companyId;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var ContactNameModel
     */
    protected $mainContact;
    /**
     * @var StatusModel
     */
    protected $status;
    /**
     * @var CompanyAddressModel
     */
    protected $primaryAddress;
    /**
     * @var CompanySummaryModel
     */
    protected $parent;
    /**
     * @var CustomFieldValueModel[]
     */
    protected $custom;
    /**
     * @var UserSummaryModel
     */
    protected $owner;
    /**
     * @var UserSummaryModel[]
     */
    protected $recruiters;
    /**
     * @var UserSummaryModel
     */
    protected $createdBy;
    /**
     * @var \DateTime
     */
    protected $createdAt;
    /**
     * @var UserSummaryModel
     */
    protected $updatedBy;
    /**
     * @var \DateTime
     */
    protected $updatedAt;
    /**
     * @var CompanyLinks
     */
    protected $links;

    /**
     * @return int
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param int $companyId
     *
     * @return self
     */
    public function setCompanyId($companyId = null)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return ContactNameModel
     */
    public function getMainContact()
    {
        return $this->mainContact;
    }

    /**
     * @param ContactNameModel $mainContact
     *
     * @return self
     */
    public function setMainContact(ContactNameModel $mainContact = null)
    {
        $this->mainContact = $mainContact;

        return $this;
    }

    /**
     * @return StatusModel
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param StatusModel $status
     *
     * @return self
     */
    public function setStatus(StatusModel $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return CompanyAddressModel
     */
    public function getPrimaryAddress()
    {
        return $this->primaryAddress;
    }

    /**
     * @param CompanyAddressModel $primaryAddress
     *
     * @return self
     */
    public function setPrimaryAddress(CompanyAddressModel $primaryAddress = null)
    {
        $this->primaryAddress = $primaryAddress;

        return $this;
    }

    /**
     * @return CompanySummaryModel
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param CompanySummaryModel $parent
     *
     * @return self
     */
    public function setParent(CompanySummaryModel $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return CustomFieldValueModel[]
     */
    public function getCustom()
    {
        return $this->custom;
    }

    /**
     * @param CustomFieldValueModel[] $custom
     *
     * @return self
     */
    public function setCustom(array $custom = null)
    {
        $this->custom = $custom;

        return $this;
    }

    /**
     * @return UserSummaryModel
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param UserSummaryModel $owner
     *
     * @return self
     */
    public function setOwner(UserSummaryModel $owner = null)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * @return UserSummaryModel[]
     */
    public function getRecruiters()
    {
        return $this->recruiters;
    }

    /**
     * @param UserSummaryModel[] $recruiters
     *
     * @return self
     */
    public function setRecruiters(array $recruiters = null)
    {
        $this->recruiters = $recruiters;

        return $this;
    }

    /**
     * @return UserSummaryModel
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param UserSummaryModel $createdBy
     *
     * @return self
     */
    public function setCreatedBy(UserSummaryModel $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return UserSummaryModel
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * @param UserSummaryModel $updatedBy
     *
     * @return self
     */
    public function setUpdatedBy(UserSummaryModel $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return self
     */
    public function setUpdatedAt(\DateTime $updatedAt = null)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return CompanyLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param CompanyLinks $links
     *
     * @return self
     */
    public function setLinks(CompanyLinks $links = null)
    {
        $this->links = $links;

        return $this;
    }
}