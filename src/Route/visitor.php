<?php

use App\Controller\Visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    /* Home */
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);

    /* Categories */
    /* --- List */
    $router->add('visitor.categories.list', '/categories')
        ->controller([VisitorController::class, 'categories']);
    /* --- Read */
    $router->add('visitor.categories.read', '/category/{id}') // @need category id or slug
        ->controller([VisitorController::class, 'category']);

    /* Posts */
    /* --- List */
    $router->add('visitor.posts.list', '/posts')
        ->controller([VisitorController::class, 'posts']);

    /* --- Read */
    $router->add('visitor.posts.read', '/post/{id}') // @need category id or slug
        ->controller([VisitorController::class, 'post']);
};
