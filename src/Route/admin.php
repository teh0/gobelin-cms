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
    $router->add('admin.manager.pages.home', 'admin/pages')
        ->controller([PageManagerController::class, 'index'])
        ->methods(['GET', 'POST']);
    /* --- Create */
    $router->add('admin.manager.pages.create', 'admin/pages/create')
        ->controller([PageManagerController::class, 'create'])
        ->methods(['GET', 'POST']);
    /* --- Read */
    $router->add('admin.manager.pages.read', '/admin/pages/{id}')
        ->controller([PageManagerController::class, 'read'])
        ->methods(['GET']);
    /* --- Update */
    $router->add('admin.manager.pages.update', 'admin/pages/update/{id}')
        ->controller([PageManagerController::class, 'update'])
        ->methods(['GET', 'POST']);
    /* --- Delete */
    $router->add('admin.manager.pages.delete', 'admin/pages/delete/{id}')
        ->controller([PageManagerController::class, 'delete'])
        ->methods(['GET']);


    /* Category */
    /* --- All */
    $router->add('admin.manager.categories.home', 'admin/categories')
        ->controller([CategoryManagerController::class, 'index'])
        ->methods(['GET', 'POST']);
    /* --- Create */
    $router->add('admin.manager.categories.create', 'admin/categories/create')
        ->controller([CategoryManagerController::class, 'create'])
        ->methods(['GET', 'POST']);
    /* --- Read */
    $router->add('admin.manager.categories.read', 'admin/category/{id}')
        ->controller([CategoryManagerController::class, 'read'])
        ->methods(['GET']);
    /* --- Update */
    $router->add('admin.manager.categories.update', 'admin/categories/update/{id}')
        ->controller([CategoryManagerController::class, 'update'])
        ->methods(['GET', 'POST']);
    /* --- Delete */
    $router->add('admin.manager.categories.delete', 'admin/categories/delete/{id}')
        ->controller([CategoryManagerController::class, 'delete'])
        ->methods(['GET']);


    /* Tag */
    /* --- All */
    $router->add('admin.manager.tags.home', 'admin/tags')
        ->controller([TagManagerController::class, 'index'])
        ->methods(['GET', 'POST']);
    /* --- Create */
    $router->add('admin.manager.tags.create', 'admin/tags/create')
        ->controller([TagManagerController::class, 'create'])
        ->methods(['GET', 'POST']);
    /* --- Read */
    $router->add('admin.manager.tags.read', 'admin/tags/{id}')
        ->controller([TagManagerController::class, 'read'])
        ->methods(['GET']);
    /* --- Update */
    $router->add('admin.manager.tags.update', 'admin/tags/update/{id}')
        ->controller([TagManagerController::class, 'update'])
        ->methods(['GET', 'POST']);
    /* --- Delete */
    $router->add('admin.manager.tags.delete', 'admin/tags/delete/{id}')
        ->controller([TagManagerController::class, 'delete'])
        ->methods(['GET']);


    /* User */
    /* --- All */
    $router->add('admin.manager.users.home', 'admin/users')
        ->controller([UserManagerController::class, 'index'])
        ->methods(['GET', 'POST']);
    /* --- Create */
    $router->add('admin.manager.users.create', 'admin/users/create')
        ->controller([UserManagerController::class, 'create'])
        ->methods(['GET', 'POST']);
    /* --- Read */
    $router->add('admin.manager.users.read', 'admin/users/{id}')
        ->controller([UserManagerController::class, 'read']);
};
