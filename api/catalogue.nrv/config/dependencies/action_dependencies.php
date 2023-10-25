<?php

use Psr\Container\ContainerInterface;
use nrv\catalogue\app\actions\GetCatalogueAction;

return[

    GetCatalogueAction::class => function (ContainerInterface $c){
        return new GetCatalogueAction($c->get('catalogue.service'));
    },

];