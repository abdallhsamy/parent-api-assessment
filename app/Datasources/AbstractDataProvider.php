<?php

namespace App\Datasources;

use App\Contracts\ProviderInterface;

abstract class AbstractDataProvider implements ProviderInterface
{
    protected $storageFolder = "dataproviders";

    abstract public function filterByStatus(string $status);

    abstract public function filterByBalanceMin(int $from);

    abstract public function filterByBalanceMax(int $to);

    abstract public function filterByCurrency(string $currency);

    public function getAll() {
        $filePath = storage_path($this->storageFolder.'/').$this->fileName;

        $json_contents = file_get_contents($filePath);

        $data = json_decode($json_contents);
        
        $filteredUsers = $data->users;

        if(!empty($this->filters)){
            foreach ($filteredUsers as $parentKey => $parent){
                foreach ($this->filters as $filter){
                    if(!$this->compareFilterValue($parent, $filter)){
                        unset($filteredUsers[$parentKey]);
                    }
                }
            }
        }

        return $filteredUsers;
    }

    private function compareFilterValue($parent, array $filter) {
        $condition = false;
        switch ($filter['operator']){
            case ">=":
                if($parent->{$filter['name']} >= $filter['value']){
                    $condition = true;
                }
                break;

            case "<=":
                if($parent->{$filter['name']} <= $filter['value']){
                    $condition = true;
                }
                break;

            case "=":
            default:
                if($parent->{$filter['name']} == $filter['value']){
                    $condition = true;
                }
                break;
        }

        return $condition;
    }
}
