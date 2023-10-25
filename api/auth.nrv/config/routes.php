<?php
declare(strict_types=1);

use nrv\auth\app\actions\SignInAction;

return function (\Slim\App $app): void {

    $app->post("/signin", SignInAction::class)->setName("signIn");
    $app->post("/refresh", \nrv\auth\app\actions\UserRefreshAction::class)->setName("refreshUser");

};
