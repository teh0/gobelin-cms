<?php

use App\Controller\Admin\AdminController;
use App\Controller\Admin\PageManager;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {

    /* Home */
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);

    /* Page */
    $router->add('admin.manager.page.home', 'admin/page')
        ->controller([PageManager::class, 'index']);

};
