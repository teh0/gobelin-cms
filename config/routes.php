<?php

$ROUTE_FOLDER = dirname(__DIR__) . '/src/Route';

return [
    require $ROUTE_FOLDER . '/visitor.php',
    require $ROUTE_FOLDER . '/admin.php',
    require $ROUTE_FOLDER . '/auth.php',
];