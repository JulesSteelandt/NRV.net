<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use nrv\auth\app\auth\managers\JwtManager;
use nrv\auth\app\auth\providers\AuthProvider;
use nrv\auth\domain\service\AuthService;
use Psr\Container\ContainerInterface;

return [
    'logger' => function (ContainerInterface $c) {
        $log = new Logger($c->get('log.name'));
        $log->pushHandler(new StreamHandler($c->get('log.file')));
        return $log;
    },

    'jwt.manager' => function (ContainerInterface $c) {
        return new JwtManager();
    },

    'authenticate.provider' => function (ContainerInterface $c) {
        return new AuthProvider($c->get('logger'));
    },

    'authenticate.service' => function (ContainerInterface $c) {
        return new AuthService($c->get('jwt.manager'), $c->get('authenticate.provider'));
    },


];