<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use nrv\catalogue\domain\service\ServiceSoiree;
use nrv\catalogue\domain\service\ServiceSpectacle;
use nrv\catalogue\domain\service\ServiceCatalogue;
use nrv\catalogue\app\provider\Provider;

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
        return new ServiceSpectacle($c->get('logger'));
    },

    'catalogue.service' => function (ContainerInterface $c) {
        return new ServiceCatalogue($c->get('logger'));
    },

    'catalogue.provider' => function (ContainerInterface $c) {
        return new Provider($c->get('catalogue.service'),$c->get('spectacle.service'),$c->get('soiree.service'));
    },

];