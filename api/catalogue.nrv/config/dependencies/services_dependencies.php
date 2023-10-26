<?php

use nrv\catalogue\app\provider\Provider;
use nrv\catalogue\domain\service\catalogue\ServiceArtiste;
use nrv\catalogue\domain\service\catalogue\ServiceCatalogue;
use nrv\catalogue\domain\service\catalogue\ServiceLieu;
use nrv\catalogue\domain\service\catalogue\ServiceSoiree;
use nrv\catalogue\domain\service\catalogue\ServiceSpectacle;
use nrv\catalogue\domain\service\catalogue\ServiceStyle;
use Psr\Container\ContainerInterface;

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

    'style.service' => function (ContainerInterface $c) {
        return new ServiceStyle();
    },

    'lieu.service' => function (ContainerInterface $c) {
        return new ServiceLieu();
    },

    'catalogue.provider' => function (ContainerInterface $c) {
        return new Provider(
            $c->get('catalogue.service'),
            $c->get('spectacle.service'),
            $c->get('soiree.service'),
            $c->get('artiste.service'),
            $c->get('style.service'),
            $c->get('lieu.service')
        );
    },

];