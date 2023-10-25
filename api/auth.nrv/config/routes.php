<?php
declare(strict_types=1);

use nrv\auth\app\actions\SignInAction;
use nrv\auth\app\actions\ValiderTokenJWTAction;

return function(\Slim\App $app):void {

    $app->post("/signin",SignInAction::class)->setName("signIn");

    $app->get('/validate', ValiderTokenJWTAction::class)
        ->setName('validateTokenJWT');
    $app->post("/refresh", \nrv\auth\app\actions\UserRefreshAction::class)->setName("refreshUser");

};
