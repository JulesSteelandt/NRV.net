<?php
declare(strict_types=1);

use pizzashop\shop\app\actions\AccederCommandeAction;
use pizzashop\shop\app\actions\CreerCommandeAction;
use pizzashop\shop\app\actions\ValiderCommandeAction;

return function( \Slim\App $app):void {

    $app->get('/spectacle/', )
        ->setName('list_spectacle');
};