<?php

namespace App\Services;

class PaginacaoService
{
    private $currentPage;
    private $itemsPerPage;
    private $totalItems;
    
    public function __construct($itemsPerPage = 15)
    {
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $_GET['page'] ?? 1;
    }
    
    public function getOffset()
    {
        return ($this->currentPage - 1) * $this->itemsPerPage;
    }
    
    public function getTotalPages()
    {
        return ceil($this->totalItems / $this->itemsPerPage);
    }
}
