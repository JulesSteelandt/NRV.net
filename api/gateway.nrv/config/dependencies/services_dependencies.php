<?php

use nrv\catalogue\app\provider\Provider;
use nrv\catalogue\domain\service\ServiceCatalogue;
use nrv\catalogue\domain\service\ServiceSoiree;
use nrv\catalogue\domain\service\ServiceSpectacle;
use Psr\Container\ContainerInterface;
use nrv\catalogue\domain\service\ServiceArtiste;

return[

    'soiree.service' => function (ContainerInterface $c) {
        return new ServiceSoiree();
    },

    'spectacle.service' => function (ContainerInterface $c) {
        return new ServiceSpectacle();
    },

    'catalogue.service' => function (ContainerInterface $c) {
        return new ServiceCatalogue();
    },

    'artiste.service' => function (ContainerInterface $c) {
        return new ServiceArtiste();
    },

    'catalogue.provider' => function (ContainerInterface $c) {
        return new Provider($c->get('catalogue.service'),$c->get('spectacle.service'),$c->get('soiree.service'),$c->get('artiste.service'));
    },

];