<?php

namespace BenBorla\JobAdder\V2\Model;

class SubCategoryModel
{
    /**
     * @var int
     */
    protected $subCategoryId;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var SkillCategoryModel[]
     */
    protected $skills;

    /**
     * @return int
     */
    public function getSubCategoryId()
    {
        return $this->subCategoryId;
    }

    /**
     * @param int $subCategoryId
     *
     * @return self
     */
    public function setSubCategoryId($subCategoryId = null)
    {
        $this->subCategoryId = $subCategoryId;

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
     * @return SkillCategoryModel[]
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param SkillCategoryModel[] $skills
     *
     * @return self
     */
    public function setSkills(array $skills = null)
    {
        $this->skills = $skills;

        return $this;
    }
}
