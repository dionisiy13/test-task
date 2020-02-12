<?php

use App\Controller\Factory\IndexControllerFactory;
use App\Controller\IndexController;
use App\Helper\CurrencyConverter;
use App\Helper\Factory\CurrencyConverterFactory;
use App\Service\ExchangeratesProvider;
use App\Service\Factory\ExchangeratesProviderFactory;
use Gregwar\Cache\Cache;
use Narrowspark\HttpEmitter\SapiEmitter;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

/** Global services Map */
$globalServices = [
    'renderer' => new PhpRenderer(__DIR__."/views"),
    'httpEmiter' => new SapiEmitter(),
    'cache' => (new Cache())->setCacheDirectory(__DIR__."/../cache")
];

/** Local services Map */
$localServices = [
    ExchangeratesProvider::class => ExchangeratesProviderFactory::class,
    CurrencyConverter::class => CurrencyConverterFactory::class
];

foreach ($localServices as &$serviceFactory) {
    $serviceFactory = (new $serviceFactory())($globalServices);
}

$services = array_merge($globalServices, $localServices);

/** Controllers Map */
$controllers = [
    IndexController::class => IndexControllerFactory::class
];

foreach ($controllers as &$controllerFactory) {
    $controllerFactory = (new $controllerFactory())($services);
}

$httpEmiter = function(ResponseInterface $response) use ($services) {
    return $services['httpEmiter']->emit($response);
};

$router = new \Bramus\Router\Router();

/* ROUTES */
$router->get('/', function() use ($controllers, $httpEmiter) {
    return $httpEmiter($controllers[IndexController::class]->indexAction());
});

$router->run();

