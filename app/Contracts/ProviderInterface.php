<?php

namespace App\Contracts;

interface ProviderInterface
{
    public function filterByStatus(string $status);
    
    public function filterByBalanceMin(int $from);
    
    public function filterByBalanceMax(int $to);
    
    public function filterByCurrency(string $currency);
    
    public function getAll();
}
