<?php
declare(strict_types=1);

use nrv\catalogue\app\actions\GetCatalogueAction;

return function( \Slim\App $app):void {

    $app->get('/catalogue[/]', GetCatalogueAction::class )
        ->setName('catalogue');
};