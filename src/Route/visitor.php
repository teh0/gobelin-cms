<?php

use App\Controller\Visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    /* Home */
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);

    // Categories list
    $router->add('visitor.categories', '/categories')
        ->controller([VisitorController::class, 'categories']);
    // --> category's post list
    $router->add('visitor.category', '/category/1') // @need category id or slug
        ->controller([VisitorController::class, 'category']);

    // Posts list
    $router->add('visitor.posts', '/posts')
        ->controller([VisitorController::class, 'posts']);

    // single post
    $router->add('visitor.post', '/post/1') // @need category id or slug
        ->controller([VisitorController::class, 'post']);
};
