<?php

use App\Controller\Error\ErrorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    /* 404 error redirection */
    $router->add('error.404', '/404')
        ->controller([ErrorController::class, 'error404']);

};
