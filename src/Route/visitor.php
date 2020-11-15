<?php

use App\Controller\Visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    /* Home */
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);

    // Categories
    $router->add('visitor.categories', '/categories')
        ->controller([VisitorController::class, 'categories']);

    // Posts
    $router->add('visitor.posts', '/posts')
        ->controller([VisitorController::class, 'posts']);
};
