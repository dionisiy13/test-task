<?php

namespace App\Controller;

use App\Contract\ICurrencyProvider;
use App\Helper\CurrencyConverter;
use GuzzleHttp\Psr7\Response;
use Slim\Views\PhpRenderer;

class IndexController
{
    /** @var  PhpRenderer */
    private $renderer;
    /** @var  \ICurrencyProvider */
    private $currencyProvider;
    /** @var  CurrencyConverter */
    private $currencyHelper;

    public function __construct(PhpRenderer $renderer, ICurrencyProvider $currencyProvider, CurrencyConverter $converter)
    {
        $this->renderer = $renderer;
        $this->currencyProvider = $currencyProvider;
        $this->currencyHelper = $converter;
    }

    public function indexAction()
    {
        $currencies = [];
        $this->currencyProvider->setBaseCurrency("USD");
        $currenciesCodes = $this->currencyProvider->getCurrencies();
        $rates = $this->currencyProvider->getRates();

        foreach ($currenciesCodes as $currency) {
            $currencies[$currency] = $this->currencyHelper->convert($currency);
        }

        return  $this->renderer->render(new Response(), "index.php", [
            'rates' => $rates,
            'currencies' => $currencies
        ]);
    }
}