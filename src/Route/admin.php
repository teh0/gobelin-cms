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

    $router->add('admin.manager.page.read', 'admin/page/1') // @need page slug or id
        ->controller([PageManager::class, 'read']);
    $router->add('admin.manager.page.update', 'admin/page/update/1') // @need page slug or id
    ->controller([PageManager::class, 'update']);
    $router->add('admin.manager.page.create', 'admin/page/create/12') // @need page slug or id
    ->controller([PageManager::class, 'create']);


    /* Category */
    $router->add('admin.manager.category.home', 'admin/category')
        ->controller([CategoryManager::class, 'index']);
    $router->add('admin.manager.category.read', 'admin/category/1') // @need page slug or id
    ->controller([CategoryManager::class, 'read']);
    $router->add('admin.manager.category.update', 'admin/category/update/1') // @need page slug or id
    ->controller([CategoryManager::class, 'update']);
    $router->add('admin.manager.category.create', 'admin/category/create/12') // @need page slug or id
    ->controller([CategoryManager::class, 'create']);

    /* Tag */
    $router->add('admin.manager.tag.home', 'admin/tag')
        ->controller([TagManager::class, 'index']);
    $router->add('admin.manager.category.read', 'admin/tag/1') // @need page slug or id
    ->controller([TagManager::class, 'read']);
    $router->add('admin.manager.category.update', 'admin/tag/update/1') // @need page slug or id
    ->controller([TagManager::class, 'update']);
    $router->add('admin.manager.category.create', 'admin/tag/create/12') // @need page slug or id
    ->controller([TagManager::class, 'create']);

    /* User */
    $router->add('admin.manager.user.home', 'admin/user')
        ->controller([UserManager::class, 'index']);
    $router->add('admin.manager.user.read', 'admin/user/1') // @need page slug or id
    ->controller([UserManager::class, 'read']);
    $router->add('admin.manager.user.update', 'admin/user/update/1') // @need page slug or id
    ->controller([UserManager::class, 'update']);
    $router->add('admin.manager.user.create', 'admin/user/create/12') // @need page slug or id
    ->controller([UserManager::class, 'create']);
};
