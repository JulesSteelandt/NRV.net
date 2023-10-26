<?php

use nrv\auth\app\actions\SignInAction;
use nrv\auth\app\actions\SignUpAction;
use nrv\auth\app\actions\UserRefreshAction;
use nrv\auth\app\actions\ValiderTokenJWTAction;
use Psr\Container\ContainerInterface;

return [
    SignInAction::class => function (ContainerInterface $c) {
        return new SignInAction($c->get('authenticate.service'));
    },

    ValiderTokenJWTAction::class => function (ContainerInterface $c) {
        return new ValiderTokenJWTAction($c->get('authenticate.service'));
    },

    UserRefreshAction::class => function (ContainerInterface $c) {
        return new UserRefreshAction($c->get('authenticate.service'));
    },

    SignUpAction::class => function (ContainerInterface $c) {
        return new SignUpAction($c->get('authenticate.service'));
    }
];