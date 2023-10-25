<?php
declare(strict_types=1);

use nrv\catalogue\app\actions\GetProgrammeAction;
use nrv\catalogue\app\actions\GetSpectacleAction;
use nrv\catalogue\app\actions\GetArtisteAction;
use Slim\App;

return function (App $app): void {

    $app->get('/programme[/]', GetProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', GetArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', GetSpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/{id}[/]', function ($request, $response, $args) {
        // Votre logique de route ici
    })->setName('soireeId');
};