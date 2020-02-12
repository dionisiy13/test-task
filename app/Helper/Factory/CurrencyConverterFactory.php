<?php

namespace App\Helper\Factory;

class CurrencyConverterFactory
{
    public function __invoke(array $services)
    {
        return new \App\Helper\CurrencyConverter($services['cache']);
    }
}