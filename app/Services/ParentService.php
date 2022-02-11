<?php

namespace App\Services;

class ParentService
{
    protected $dataSources = [
        'DataProviderX',
        'DataProviderY'
    ];

    protected $allowedFilters = [
        'provider',
        'statusCode',
        'balanceMin',
        'balanceMax',
        'currency'
    ];

    public function getAllParents(array $filters = [])
    {
        $parents = [];

        $filters = $this->validateFilters($filters);


        $dataSources = $this->getValidDataSources($filters);

        foreach ($dataSources as $dataSource){

            $this->processFilters($dataSource, $filters);

            $parents = array_merge($parents, $dataSource->getAll());

            return $parents;
        }

        return $parents;
    }

    protected function validateFilters(array $filters = [])
    {
        $allowedFilters = $this->allowedFilters;
        $filtered = array_filter(
            $filters,
            function ($key) use ($allowedFilters) {
                return in_array($key, $allowedFilters);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $filtered;
    }

    protected function getValidDataSources(array $filters = []):array
    {
        $dataSources = [];

        if(array_key_exists('provider', $filters) && in_array($filters['provider'], $this->dataSources)){
            $dataSources[] = app('App\Datasources\\'.$filters['provider']);

        }else{
            foreach ($this->dataSources as $dataSource){
                $dataSources[] = app('App\Datasources\\'.$dataSource);
            }
        }

        return $dataSources;
    }

    protected function processFilters($dataSource, $filters = [])
    {
        if(!empty($filters)){
            if(array_key_exists('statusCode', $filters) && !empty($filters['statusCode'])){
                $dataSource->filterByStatus($filters['statusCode']);
            }

            if(array_key_exists('balanceMin', $filters) && $filters['balanceMin'] >= 0){
                $dataSource->filterByBalanceMin($filters['balanceMin']);
            }

            if(array_key_exists('balanceMax', $filters) && $filters['balanceMax'] >= 0){
                $dataSource->filterByBalanceMax($filters['balanceMax']);
            }

            if(array_key_exists('currency', $filters) && !empty($filters['currency'])){
                $dataSource->filterByCurrency($filters['currency']);
            }
        }

    }
}
