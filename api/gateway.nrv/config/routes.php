<?php

use nrv\gateway\actions\catalogue\ArtisteAction;
use nrv\gateway\actions\catalogue\ProgrammeAction;
use nrv\gateway\actions\catalogue\SoireeAction;
use nrv\gateway\actions\catalogue\SpectacleAction;
use nrv\gateway\actions\catalogue\StyleAction;
use nrv\gateway\actions\catalogue\StyleListAction;
use Slim\App;
use nrv\gateway\actions\auth\RefreshAction;
use nrv\gateway\actions\auth\SignUpAction;
use nrv\gateway\actions\auth\SignInAction;
use nrv\gateway\actions\auth\ValidateAction;

return function (App $app): void {

    $app->get('/programme[/]', ProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', ArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', SpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/{id}[/]', SoireeAction::class)->setName('soireeId');

    $app->get('/style[/]', StyleListAction::class)->setName('style');

    $app->get('/style/{id}[/]', StyleAction::class)->setName('styleId');

    $app->post('/refresh[/]', RefreshAction::class)->setName('refresh');

    $app->post('/signin[/]', SignInAction::class)->setName('signin');

    $app->post('/signup[/]', SignUpAction::class)->setName('signup');

    $app->get('/validate[/]', ValidateAction::class)->setName('validate');


    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', ['http://localhost:32108','https://webetu.iutnc.univ-lorraine.fr/'])
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials','true');
    });
};