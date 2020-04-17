<?php


class paginate
{
    public $currentPage;
    public $itemPerPage;
    public $itemTotalCount;

    public function __construct($currentPage = 1 , $itemPerPage = 4, $itemTotalCount = 0)
    {
        $this->currentPage      = (int)$currentPage;
        $this->itemPerPage      = (int)$itemPerPage;
        $this->itemTotalCount   = (int)$itemTotalCount;
    }

    public function next(){
        return $this->currentPage + 1;
    }

    public function previous(){
        return $this->currentPage -1;
    }

    public function pageTotal(){
        return ceil($this->itemTotalCount/$this->itemPerPage);
    }

    public function hasPrevious(){
        return $this->previous() >= 1 ? true : false;
    }

    public function hasNext(){
        return $this->next() <= $this->pageTotal() ? true : false;
    }

    public function offset(){
        return ($this->currentPage - 1) * $this->itemPerPage;
    }

}