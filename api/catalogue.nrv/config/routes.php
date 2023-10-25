<?php
declare(strict_types=1);

use nrv\catalogue\app\actions\GetProgrammeAction;

return function( \Slim\App $app):void {

    $app->get('/programme[/]', GetProgrammeAction::class )
        ->setName('programme');

    $app->get('/spectacle/{id}[/]', function ($request, $response, $args) {
        // Votre logique de route ici
    })->setName('spectacleId');

    $app->get('/soiree/{id}[/]', function ($request, $response, $args) {
        // Votre logique de route ici
    })->setName('soireeId');
};