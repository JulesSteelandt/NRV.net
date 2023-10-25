<?php

use Psr\Container\ContainerInterface;
use nrv\catalogue\app\actions\GetProgrammeAction;

return[

    GetProgrammeAction::class => function (ContainerInterface $c){
        return new GetProgrammeAction($c->get('catalogue.provider'));
    },

];