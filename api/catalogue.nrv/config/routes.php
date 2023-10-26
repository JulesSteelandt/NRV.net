<?php

use nrv\catalogue\app\actions\GetProgrammeAction;
use nrv\catalogue\app\actions\GetSpectacleAction;
use nrv\catalogue\app\actions\GetArtisteAction;
use nrv\catalogue\app\actions\GetSoireeIdAction;
use Slim\App;
use nrv\catalogue\app\actions\GetStyleAction;
use nrv\catalogue\app\actions\GetStyleByIdAction;

return function (App $app): void {

    $app->get('/programme[/]', GetProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', GetArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', GetSpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/{id}[/]', GetSoireeIdAction::class)->setName('soireeId');

    $app->get('/style[/]', GetStyleAction::class)->setName('soireeId');

    $app->get('/style/{id}[/]', GetStyleByIdAction::class)->setName('soireeId');

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', 'http://gateway.nrv')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};