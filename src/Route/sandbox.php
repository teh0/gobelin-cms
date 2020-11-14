<?php

use App\Controller\Sandbox\SandboxController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $router) {
    if ($_SERVER['APP_ENV'] === 'dev') {

        $router->add('sandbox', '/sandbox')
            ->controller([SandboxController::class, 'index'])
            ->methods(['GET']);
    }
};