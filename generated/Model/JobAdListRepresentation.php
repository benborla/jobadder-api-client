<?php

namespace BenBorla\JobAdder\V2\Model;

class JobAdListRepresentation
{
    /**
     * @var JobAdSummaryModel[]
     */
    protected $items;
    /**
     * @var int
     */
    protected $totalCount;
    /**
     * @var PageLinks
     */
    protected $links;

    /**
     * @return JobAdSummaryModel[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param JobAdSummaryModel[] $items
     *
     * @return self
     */
    public function setItems(array $items = null)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     *
     * @return self
     */
    public function setTotalCount($totalCount = null)
    {
        $this->totalCount = $totalCount;

        return $this;
    }

    /**
     * @return PageLinks
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * @param PageLinks $links
     *
     * @return self
     */
    public function setLinks(PageLinks $links = null)
    {
        $this->links = $links;

        return $this;
    }
}
