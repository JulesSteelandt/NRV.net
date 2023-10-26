<?php

use nrv\gateway\actions\catalogue\ArtisteAction;
use nrv\gateway\actions\catalogue\ProgrammeAction;
use nrv\gateway\actions\catalogue\SoireeAction;
use nrv\gateway\actions\catalogue\SpectacleAction;
use nrv\gateway\actions\catalogue\StyleAction;
use nrv\gateway\actions\catalogue\StyleListAction;
use Psr\Container\ContainerInterface;

return[

    ProgrammeAction::class => function (ContainerInterface $c){
        return new ProgrammeAction($c->get('provider.client'));
    },

    SpectacleAction::class => function (ContainerInterface $c){
        return new SpectacleAction($c->get('provider.client'));
    },

    ArtisteAction::class => function (ContainerInterface $c){
        return new ArtisteAction($c->get('provider.client'));
    },

    SoireeAction::class => function (ContainerInterface $c){
        return new SoireeAction($c->get('provider.client'));
    },

    StyleListAction::class => function (ContainerInterface $c){
        return new StyleListAction($c->get('provider.client'));
    },

    StyleAction::class => function (ContainerInterface $c){
        return new StyleAction($c->get('provider.client'));
    },

];