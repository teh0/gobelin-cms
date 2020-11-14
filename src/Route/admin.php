<?php

use App\Controller\Admin\AdminController;
use App\Controller\Admin\PageManager;
use App\Controller\Admin\CategoryManager;
use App\Controller\Admin\TagManager;
use App\Controller\Admin\UserManager;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {

    /* Home */
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);

    /* Page */
    $router->add('admin.manager.page.home', 'admin/page')
        ->controller([PageManager::class, 'index']);

    /* Category */
    $router->add('admin.manager.category.home', 'admin/category')
        ->controller([CategoryManager::class, 'index']);

    /* Tag */
    $router->add('admin.manager.tag.home', 'admin/tag')
        ->controller([TagManager::class, 'index']);

    /* Tag */
    $router->add('admin.manager.user.home', 'admin/user')
        ->controller([UserManager::class, 'index']);
};
