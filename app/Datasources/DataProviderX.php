<?php

namespace App\Datasources;

class DataProviderX extends AbstractDataProvider
{
    protected $fileName = "DataProviderX.json";

    protected $filters = [];

    protected $statusCodes = [
        'authorised' => 1,
        'decline' => 2,
        'refunded' => 3
    ];

    public function filterByStatus(string $status)
    {
        if(array_key_exists($status, $this->statusCodes)) {
            $this->filters[] = [
                'name' => 'statusCode',
                'value' => $this->statusCodes[$status],
                'operator' => '='
            ];
        } else {
            $this->filters[] = [
                'name' => 'statusCode',
                'value' => 0,
                'operator' => '='
            ];
        }
    }

    public function filterByBalanceMin(int $from) {
        $this->filters[] = [
            'name' => 'parentAmount',
            'value' => $from,
            'operator' => '>='
        ];
    }

    public function filterByBalanceMax(int $to) {
        $this->filters[] = [
            'name' => 'parentAmount',
            'value' => $to,
            'operator' => '<='
        ];
    }

    public function filterByCurrency(string $currency) {
        $this->filters[] = [
            'name' => 'Currency',
            'value' => $currency,
            'operator' => '='
        ];
    }
}
