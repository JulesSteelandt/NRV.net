<?php
declare(strict_types=1);

use nrv\catalogue\app\actions\GetProgrammeAction;
use nrv\catalogue\app\actions\GetSpectacleAction;
use nrv\catalogue\app\actions\GetArtisteAction;
use nrv\catalogue\app\actions\GetSoireeIdAction;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\App;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

return function (App $app): void {

    $app->options('/{routes:.+}', function (Request $rq,
                                            RequestHandlerInterface $next ): ResponseInterface {
        if (! $rq->hasHeader('Origin'))
            New HttpUnauthorizedException ($rq, "missing Origin Header (cors)");
        $response = $next->handle($rq);
        $response = $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Methods', 'POST, PUT, GET' )
            ->withHeader('Access-Control-Allow-Headers','Authorization' )
            ->withHeader('Access-Control-Max-Age', 3600)
            ->withHeader('Access-Control-Allow-Credentials', 'true');
        return $response;
    });

    $app->get('/programme[/]', GetProgrammeAction::class)->setName('programme');

    $app->get('/artiste/{id}[/]', GetArtisteAction::class)->setName('ArtisteId');

    $app->get('/spectacle/{id}[/]', GetSpectacleAction::class)->setName('spectacleId');

    $app->get('/soiree/{id}[/]', GetSoireeIdAction::class)->setName('soireeId');
};