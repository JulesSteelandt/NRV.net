<?php

use nrv\gateway\actions\catalogue\ArtisteAction;
use nrv\gateway\actions\catalogue\ProgrammeAction;
use nrv\gateway\actions\catalogue\SoireeAction;
use nrv\gateway\actions\catalogue\SpectacleAction;
use nrv\gateway\actions\catalogue\StyleAction;
use nrv\gateway\actions\catalogue\StyleListAction;
use Slim\App;

return function (App $app): void {

    $app->get('/programme[/]', ProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', ArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', SpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/{id}[/]', SoireeAction::class)->setName('soireeId');

    $app->get('/style[/]', StyleListAction::class)->setName('soireeId');

    $app->get('/style/{id}[/]', StyleAction::class)->setName('soireeId');


    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};