<?php

use nrv\catalogue\app\actions\catalogue\GetProgrammeAction;
use Psr\Container\ContainerInterface;

return[

    GetProgrammeAction::class => function (ContainerInterface $c){
        return new GetProgrammeAction($c->get('catalogue.provider'));
    },

];