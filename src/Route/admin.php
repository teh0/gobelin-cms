<?php

use App\Controller\Admin\AdminController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {

    /* Home */
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);
};