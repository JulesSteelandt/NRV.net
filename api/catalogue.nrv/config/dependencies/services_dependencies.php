<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;

return[

    'logger' => function (ContainerInterface $c) {
        $log = new Logger($c->get('log.name'));
        $log->pushHandler(new StreamHandler($c->get('log.file')));
        return $log;
    },

];