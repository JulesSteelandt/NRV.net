<?php

use nrv\catalogue\app\actions\catalogue\GetArtisteAction;
use nrv\catalogue\app\actions\catalogue\GetProgrammeAction;
use nrv\catalogue\app\actions\catalogue\GetSoireeIdAction;
use nrv\catalogue\app\actions\catalogue\GetSpectacleAction;
use nrv\catalogue\app\actions\catalogue\GetStyleAction;
use nrv\catalogue\app\actions\catalogue\GetStyleByIdAction;
use Slim\App;

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
            ->withHeader('Access-Control-Allow-Origin', ['http://localhost:32107','http://docketu.iutnc.univ-lorraine.fr:32104'])
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials','true');
    });
};