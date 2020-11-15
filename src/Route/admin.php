<?php

use App\Controller\Admin\AdminController;
use App\Controller\Admin\CategoryManagerController;
use App\Controller\Admin\PageManagerController;
use App\Controller\Admin\TagManagerController;
use App\Controller\Admin\UserManagerController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {

    /* Home */
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);


    /* Page */
    /* --- All */
    $router->add('admin.manager.page.home', 'admin/page')
        ->controller([PageManagerController::class, 'index']);
    /* --- Read */
    $router->add('admin.manager.page.read', '/admin/page/{id}')
        ->controller([PageManagerController::class, 'read']);
    /* --- Update */
    $router->add('admin.manager.page.update', 'admin/page/update/{id}')
        ->controller([PageManagerController::class, 'update']);
    /* --- Create */
    $router->add('admin.manager.page.create', 'admin/page/create')
        ->controller([PageManagerController::class, 'create']);


    /* Category */
    /* --- All */
    $router->add('admin.manager.category.home', 'admin/category')
        ->controller([CategoryManagerController::class, 'index']);
    /* --- Read */
    $router->add('admin.manager.category.read', 'admin/category/{id}')
        ->controller([CategoryManagerController::class, 'read'])
        ->methods(['GET']);
    /* --- Update */
    $router->add('admin.manager.category.update', 'admin/category/update/{id}')
        ->controller([CategoryManagerController::class, 'update']);
    /* --- Create */
    $router->add('admin.manager.category.create', 'admin/category/create')
        ->controller([CategoryManagerController::class, 'create']);


    /* Tag */
    /* --- All */
    $router->add('admin.manager.tag.home', 'admin/tag')
        ->controller([TagManagerController::class, 'index']);
    /* --- Read */
    $router->add('admin.manager.tag.read', 'admin/tag/1')
    ->controller([TagManagerController::class, 'read']);
    /* --- Update */
    $router->add('admin.manager.tag.update', 'admin/tag/update/{id}')
    ->controller([TagManagerController::class, 'update']);
    /* --- Create */
    $router->add('admin.manager.tag.create', 'admin/tag/create')
    ->controller([TagManagerController::class, 'create']);


    /* User */
    /* --- All */
    $router->add('admin.manager.user.home', 'admin/user')
        ->controller([UserManagerController::class, 'index']);
    /* --- Read */
    $router->add('admin.manager.user.read', 'admin/user/{id}')
    ->controller([UserManagerController::class, 'read']);
    /* --- Update */
    $router->add('admin.manager.user.update', 'admin/user/update/{id}')
    ->controller([UserManagerController::class, 'update']);
    /* --- Create */
    $router->add('admin.manager.user.create', 'admin/user/create')
    ->controller([UserManagerController::class, 'create']);
};
