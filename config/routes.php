<?php

use App\Controller\Admin\AdminController;
use App\Controller\Security\SecurityController;
use App\Controller\Visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    // SECURITY
    //--- LOGIN
    $router->add('login', '/login')
        ->controller([SecurityController::class, 'login'])
        ->methods(['GET', 'POST']);

    // ADMIN
    //--- HOME
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);

    // VISITOR
    //--- HOME
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);
};