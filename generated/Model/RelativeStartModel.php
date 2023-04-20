<?php

namespace BenBorla\JobAdder\V2\Model;

class RelativeStartModel
{
    /**
     * @var int
     */
    protected $period;
    /**
     * @var string
     */
    protected $unit;

    /**
     * @return int
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param int $period
     *
     * @return self
     */
    public function setPeriod($period = null)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     *
     * @return self
     */
    public function setUnit($unit = null)
    {
        $this->unit = $unit;

        return $this;
    }
}
