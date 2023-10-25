<?php

use Psr\Container\ContainerInterface;
use nrv\gateway\actions\ProgrammeAction;

return[

    ProgrammeAction::class => function (ContainerInterface $c){
        return new ProgrammeAction($c->get('provider.client'));
    },

];