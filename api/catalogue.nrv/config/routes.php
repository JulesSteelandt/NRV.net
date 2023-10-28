<?php

use nrv\catalogue\app\actions\catalogue\GetArtisteAction;
use nrv\catalogue\app\actions\catalogue\GetLieuAction;
use nrv\catalogue\app\actions\catalogue\GetProgrammeAction;
use nrv\catalogue\app\actions\catalogue\GetSoireeIdAction;
use nrv\catalogue\app\actions\catalogue\GetSoireeStatAction;
use nrv\catalogue\app\actions\catalogue\GetSpectacleAction;
use nrv\catalogue\app\actions\catalogue\GetStyleAction;
use nrv\catalogue\app\actions\catalogue\GetStyleByIdAction;
use nrv\catalogue\app\actions\commande\GetBilletByRefAction;
use nrv\catalogue\app\actions\commande\GetBilletByUserAction;
use nrv\catalogue\app\actions\commande\GetPanierByUserAction;
use nrv\catalogue\app\actions\commande\PayerCommandeAction;
use Slim\App;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Routing\RouteCollectorProxy;

return function (App $app): void {

    $app->get('/programme[/]', GetProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', GetArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', GetSpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/stat[/]', GetSoireeStatAction::class)->setName('soireeStat');

    $app->get('/soiree/{id}[/]', GetSoireeIdAction::class)->setName('soireeId');

    $app->get('/style[/]', GetStyleAction::class)->setName('style');

    $app->get('/lieu[/]', GetLieuAction::class)->setName('lieu');

    $app->group('/billet', function (RouteCollectorProxy $group) {
        $group->get('/{id}', GetBilletByRefAction::class)->setName('billetRef');
        $group->get('/user/{mail:[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}}[/]', GetBilletByUserAction::class)->setName('billetMail');
    });


    $app->post('/payer/{id}[/]', PayerCommandeAction::class)->setName('payerCommande');


    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response; // Renvoie une réponse HTTP vide
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        if (!$request->hasHeader('Origin')) {
            $origin = '*';
        } else {
            $origin = $request->getHeader('Origin');
        }
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials', 'true');
    });
};