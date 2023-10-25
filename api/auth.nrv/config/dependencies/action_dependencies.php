<?php

use nrv\auth\app\actions\SignInAction;
use nrv\auth\app\actions\UserRefreshAction;
use Psr\Container\ContainerInterface;

return [
    SignInAction::class => function (ContainerInterface $c) {
        return new SignInAction($c->get('authenticate.service'));
    },

    UserRefreshAction::class => function (ContainerInterface $c) {
        return new UserRefreshAction($c->get('authenticate.service'));
    }

];