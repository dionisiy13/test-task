<?php

namespace App\Service;

use App\Contract\ICurrencyProvider;
use Gregwar\Cache\Cache;

class ExchangeratesProvider implements ICurrencyProvider
{
    const ENDPOINT = 'https://api.exchangeratesapi.io/latest';
    const ONE_HOUR = 3600;

    private $base = 'USD';
    private $result = [];

    /** @var Cache */
    private $cache;

    public function __construct(Cache $cache)
    {
        $this->cache = $cache;
    }

    public function getRates(): array
    {
        $this->sendRequest();
        return $this->result['rates'];
    }

    public function getCurrencies(): array
    {
        $this->sendRequest();
        if (!empty($this->result)) {
            return array_keys($this->result['rates']);
        }
        return [];
    }

    public function setBaseCurrency(string $base): void
    {
        $this->base = $base;
    }

    public function sendRequest(): void
    {
        if ($this->cache->exists("currencies.json", ['max-age'=>self::ONE_HOUR])) {
            $result = $this->cache->get("currencies.json", ['max-age'=>self::ONE_HOUR]);
        } else {
            $result = file_get_contents(self::ENDPOINT."?base=".$this->base);

            if ($result) {
                $this->cache->set("currencies.json",$result);
            }
        }

        $this->result = json_decode($result ?? [], true);
    }
}