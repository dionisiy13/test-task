<?php

namespace App\Controller\Factory;

use App\Helper\CurrencyConverter;
use App\Service\ExchangeratesProvider;

class IndexControllerFactory
{
    public function __invoke(array $services)
    {
        return new \App\Controller\IndexController(
            $services['renderer'],
            $services[ExchangeratesProvider::class],
            $services[CurrencyConverter::class]
        );
    }
}