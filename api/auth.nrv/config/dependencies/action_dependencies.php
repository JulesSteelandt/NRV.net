<?php

use nrv\auth\app\actions\SignInAction;
use Psr\Container\ContainerInterface;

return [
    SignInAction::class => function (ContainerInterface $c) {
        return new SignInAction($c->get('authenticate.service'));
    },

];