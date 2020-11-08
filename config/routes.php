<?php

use App\Controller\admin\AdminController;
use App\Controller\visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    // ADMIN
    //--- HOME
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);

    // VISITOR
    //--- HOME
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);
};