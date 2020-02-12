<?php

namespace App\Contract;

interface ICurrencyProvider
{
    public function getRates(): array;
    public function getCurrencies(): array;
    public function setBaseCurrency(string $base): void;
    public function sendRequest(): void;
}