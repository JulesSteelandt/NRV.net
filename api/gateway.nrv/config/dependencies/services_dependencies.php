<?php

use nrv\gateway\client\ClientApi;
use nrv\gateway\provider\Provider;
use Psr\Container\ContainerInterface;

return[

    'catalogue.client' => function (ContainerInterface $c) {
        return new ClientApi(['base_uri' => 'http://api.nrv.catalogue']);
    },

    'provider.client' => function (ContainerInterface $c) {
        return new Provider($c->get('catalogue.client'));
    },

];