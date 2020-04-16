<?php


class paginate
{
    public $currentPage;
    public $itemPerPage;
    public $itemTotalCount;

    public function __construct( $currentPage = 1 , $itemPerPage = 4, $itemTotalCount = 0)
    {
        $this->currentPage      = (int)$currentPage;
        $this->itemPerPage      = (int)$itemPerPage;
        $this->itemTotalCount   = (int)$itemTotalCount;
    }
}