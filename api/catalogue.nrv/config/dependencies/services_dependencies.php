<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use nrv\catalogue\domain\service\ServiceSoiree;
use nrv\catalogue\domain\service\ServiceSpectacle;

return[

    'logger' => function (ContainerInterface $c) {
        $log = new Logger($c->get('log.name'));
        $log->pushHandler(new StreamHandler($c->get('log.file')));
        return $log;
    },

    'soiree.service' => function (ContainerInterface $c) {
        return new ServiceSoiree($c->get('logger'));//pas de logger pour l'instant
    },

    'spectacle.service' => function (ContainerInterface $c) {
        return new ServiceSpectacle($c->get('soiree.service'),$c->get('logger'));
    },

];