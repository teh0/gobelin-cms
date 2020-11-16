<?php

$ROUTE_FOLDER = dirname(__DIR__) . '/src/Route';

return [
    require $ROUTE_FOLDER . '/visitor.php',
    require $ROUTE_FOLDER . '/admin.php',
    require $ROUTE_FOLDER . '/auth.php',
    require $ROUTE_FOLDER . '/sandbox.php',
    require $ROUTE_FOLDER . '/error.php'
];
