<?php

use nrv\gateway\actions\auth\RefreshAction;
use nrv\gateway\actions\auth\SignInAction;
use nrv\gateway\actions\auth\SignUpAction;
use nrv\gateway\actions\auth\ValidateAction;
use nrv\gateway\actions\catalogue\ArtisteAction;
use nrv\gateway\actions\catalogue\ListLieuAction;
use nrv\gateway\actions\catalogue\ProgrammeAction;
use nrv\gateway\actions\catalogue\SoireeAction;
use nrv\gateway\actions\catalogue\SoireeStatAction;
use nrv\gateway\actions\catalogue\SpectacleAction;
use nrv\gateway\actions\catalogue\StyleAction;
use nrv\gateway\actions\catalogue\StyleListAction;
use nrv\gateway\actions\commande\BilletRefAction;
use nrv\gateway\actions\commande\BilletUserAction;
use nrv\gateway\actions\commande\PayerCommandeAction;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app): void {

    $app->get('/programme[/]', ProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', ArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', SpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/stat[/]', SoireeStatAction::class)->setName('soireeStat');

    $app->get('/soiree/{id}[/]', SoireeAction::class)->setName('soireeId');

    $app->get('/style[/]', StyleListAction::class)->setName('style');

    $app->get('/style/{id}[/]', StyleAction::class)->setName('styleId');

    $app->post('/refresh[/]', RefreshAction::class)->setName('refresh');

    $app->post('/signin[/]', SignInAction::class)->setName('signin');

    $app->post('/signup[/]', SignUpAction::class)->setName('signup');

    $app->get('/validate[/]', ValidateAction::class)->setName('validate');

    $app->group('/billet', function (RouteCollectorProxy $group) {
        $group->get('/{id}', BilletRefAction::class)->setName('billetRef');
        $group->get('/user/{mail:[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}}[/]', BilletUserAction::class)->setName('billetMail');
    });

    $app->get('/lieu[/]', ListLieuAction::class)->setName('lieu');

    $app->post('/payer/{id}[/]', PayerCommandeAction::class)->setName('payerCommande');

    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {

        $response = $handler->handle($request);
        if (!$request->hasHeader('Origin')){
            $origin = '*';
        }else {
            $origin = $request->getHeader('Origin');
        }
        return $response
            ->withHeader('Access-Control-Allow-Origin', $origin)
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS')
            ->withHeader('Access-Control-Allow-Credentials','true');
    });
};