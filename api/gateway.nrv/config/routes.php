<?php

use nrv\gateway\actions\ProgrammeAction;
use Slim\App;

return function (App $app): void {

    $app->get('/programme[/]', ProgrammeAction::class)->setName('programme');

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });
};