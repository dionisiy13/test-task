<?php

namespace App\Service\Factory;

use App\Service\ExchangeratesProvider;

class ExchangeratesProviderFactory
{
    public function __invoke(array $services)
    {
        return new ExchangeratesProvider($services['cache']);
    }
}