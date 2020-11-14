<?php

use App\Controller\Visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    /* Home */
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);
};
