<?php

use nrv\gateway\actions\catalogue\ArtisteAction;
use nrv\gateway\actions\catalogue\ProgrammeAction;
use nrv\gateway\actions\catalogue\SoireeAction;
use nrv\gateway\actions\catalogue\SpectacleAction;
use nrv\gateway\actions\catalogue\StyleAction;
use nrv\gateway\actions\catalogue\StyleListAction;
use nrv\gateway\actions\commande\BilletUserAction;
use Psr\Container\ContainerInterface;
use nrv\gateway\actions\auth\RefreshAction;
use nrv\gateway\actions\auth\SignInAction;
use nrv\gateway\actions\auth\SignUpAction;
use nrv\gateway\actions\auth\ValidateAction;

return[

    ProgrammeAction::class => function (ContainerInterface $c){
        return new ProgrammeAction($c->get('provider.client.catalogue'));
    },

    SpectacleAction::class => function (ContainerInterface $c){
        return new SpectacleAction($c->get('provider.client.catalogue'));
    },

    ArtisteAction::class => function (ContainerInterface $c){
        return new ArtisteAction($c->get('provider.client.catalogue'));
    },

    SoireeAction::class => function (ContainerInterface $c){
        return new SoireeAction($c->get('provider.client.catalogue'));
    },

    StyleListAction::class => function (ContainerInterface $c){
        return new StyleListAction($c->get('provider.client.catalogue'));
    },

    StyleAction::class => function (ContainerInterface $c){
        return new StyleAction($c->get('provider.client.catalogue'));
    },

    RefreshAction::class => function (ContainerInterface $c){
        return new RefreshAction($c->get('provider.client.auth'));
    },

    SignInAction::class => function (ContainerInterface $c){
        return new SignInAction($c->get('provider.client.auth'));
    },

    ValidateAction::class => function (ContainerInterface $c){
        return new ValidateAction($c->get('provider.client.auth'));
    },

    SignUpAction::class => function (ContainerInterface $c){
        return new SignUpAction($c->get('provider.client.auth'));
    },

    BilletUserAction::class => function (ContainerInterface $c){
        return new BilletUserAction($c->get('provider.client.catalogue'));
    },


];