<?php

use nrv\gateway\client\CatalogueClient;
use nrv\gateway\provider\Provider;
use Psr\Container\ContainerInterface;

return[

    'catalogue.client' => function (ContainerInterface $c) {
        return new CatalogueClient(['base_uri' => 'http://api.nrv.catalogue']);
    },

    'provider.client' => function (ContainerInterface $c) {
        return new Provider($c->get('catalogue.client'));
    },

];