<?php

use nrv\catalogue\app\actions\catalogue\GetArtisteAction;
use nrv\catalogue\app\actions\catalogue\GetProgrammeAction;
use nrv\catalogue\app\actions\catalogue\GetSoireeIdAction;
use nrv\catalogue\app\actions\catalogue\GetSpectacleAction;
use nrv\catalogue\app\actions\catalogue\GetStyleAction;
use nrv\catalogue\app\actions\catalogue\GetStyleByIdAction;
use nrv\catalogue\app\actions\commande\GetBilletByUserAction;
use nrv\catalogue\app\actions\commande\GetPanierByUserAction;
use Psr\Container\ContainerInterface;

return[

    GetProgrammeAction::class => function (ContainerInterface $c){
        return new GetProgrammeAction($c->get('catalogue.provider'));
    },

    GetArtisteAction::class => function (ContainerInterface $c){
        return new GetArtisteAction($c->get('catalogue.provider'));
    },

    GetSoireeIdAction::class => function (ContainerInterface $c){
        return new GetSoireeIdAction($c->get('catalogue.provider'));
    },

    GetStyleByIdAction::class => function (ContainerInterface $c){
        return new GetStyleByIdAction($c->get('catalogue.provider'));
    },

    GetStyleAction::class => function (ContainerInterface $c){
        return new GetStyleAction($c->get('catalogue.provider'));
    },

    GetSpectacleAction::class => function (ContainerInterface $c){
        return new GetSpectacleAction($c->get('catalogue.provider'));
    },

    GetBilletByUserAction::class => function (ContainerInterface $c){
        return new GetBilletByUserAction($c->get('commande.provider'));
    },

    GetPanierByUserAction::class => function (ContainerInterface $c){
        return new GetPanierByUserAction($c->get('commande.provider'));
    },

];