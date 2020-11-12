<?php

use App\Controller\Admin\AdminController;
use App\Controller\Security\SecurityController;
use App\Controller\Visitor\VisitorController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    // SECURITY
    //--- REGISTER
    $router->add('register', '/register')
        ->controller([SecurityController::class, 'register'])
        ->methods(['GET', 'POST']);
    //--- SEND EMAIL VERIFICATION REQUEST
    $router->add('send_email_verification', '/sendMailVerification')
        ->controller([SecurityController::class, 'sendEmailVerificationRequest'])
        ->methods(['GET']);
    //--- VERIFY EMAIL ADDRESS
    $router->add('verify_email', '/verify/mail')
        ->controller([SecurityController::class, 'verifyUserEmail'])
        ->methods(['GET']);
    //--- LOGIN
    $router->add('login', '/login')
        ->controller([SecurityController::class, 'login'])
        ->methods(['GET', 'POST']);
    //--- LOGOUT
    $router->add('logout', '/logout');

    // ADMIN
    //--- HOME
    $router->add('admin.home', 'admin/')
        ->controller([AdminController::class, 'index']);

    // VISITOR
    //--- HOME
    $router->add('visitor.home', '/')
        ->controller([VisitorController::class, 'index']);
};