<?php

namespace App\Helper;

class CurrencyConverter
{
    const FILE = "iso4217_ru.json";

    private $currencyMap = [];

    public function __construct()
    {
        $this->processDataFile();
    }

    private function processDataFile(): void
    {
        $data = file_get_contents(__DIR__."/../../data/".self::FILE);

        $data = json_decode($data, true);

        foreach ($data as $item) {
            $this->currencyMap[$item['STRCODE']] = $item['NAME'];
        }
    }

    public function convert(string $code): string
    {
        return $this->currencyMap[$code] ?? $code;
    }
}