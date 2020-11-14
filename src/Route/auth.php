<?php

use App\Controller\Security\SecurityController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    /* Register */
    $router->add('register', '/register')
        ->controller([SecurityController::class, 'register'])
        ->methods(['GET', 'POST']);

    /* Login */
    $router->add('login', '/login')
        ->controller([SecurityController::class, 'login'])
        ->methods(['GET', 'POST']);

    /* Logout */
    $router->add('logout', '/logout');

    /* Send email verification request */
    $router->add('send_email_verification', '/sendMailVerification')
        ->controller([SecurityController::class, 'sendEmailVerificationRequest'])
        ->methods(['GET']);

    /* Verify email address */
    $router->add('verify_email', '/verify/mail')
        ->controller([SecurityController::class, 'verifyUserEmail'])
        ->methods(['GET']);
};