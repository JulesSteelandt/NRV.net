<?php
declare(strict_types=1);

use nrv\auth\app\actions\SignInAction;
use nrv\auth\app\actions\SignUpAction;
use nrv\auth\app\actions\ValiderTokenJWTAction;

return function(\Slim\App $app):void {

    $app->post("/signin",SignInAction::class)->setName("signIn");
    $app->get('/validate', ValiderTokenJWTAction::class)
        ->setName('validateTokenJWT');
    $app->post("/refresh", \nrv\auth\app\actions\UserRefreshAction::class)->setName("refreshUser");
    $app->post("/signup", SignUpAction::class)->setName("singUp");

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
