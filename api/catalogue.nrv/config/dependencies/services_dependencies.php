<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use nrv\catalogue\app\provider\ProviderCatalogue;
use nrv\catalogue\app\provider\ProviderCommande;
use nrv\catalogue\domain\service\catalogue\ServiceArtiste;
use nrv\catalogue\domain\service\catalogue\ServiceCatalogue;
use nrv\catalogue\domain\service\catalogue\ServiceLieu;
use nrv\catalogue\domain\service\catalogue\ServiceSoiree;
use nrv\catalogue\domain\service\catalogue\ServiceSpectacle;
use nrv\catalogue\domain\service\catalogue\ServiceStyle;
use nrv\catalogue\domain\service\commande\ServiceBillet;
use nrv\catalogue\domain\service\commande\ServicePanier;
use Psr\Container\ContainerInterface;

return[
    'logger' => function (ContainerInterface $c) {
        $log = new Logger($c->get('log.name'));
        $log->pushHandler(new StreamHandler($c->get('log.file')));
        return $log;
    },

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

    'billet.service' => function (ContainerInterface $c) {
        return new ServiceBillet();
    },

    'panier.service' => function (ContainerInterface $c) {
        return new ServicePanier();
    },

    'catalogue.provider' => function (ContainerInterface $c) {
        return new ProviderCatalogue(
            $c->get('catalogue.service'),
            $c->get('spectacle.service'),
            $c->get('soiree.service'),
            $c->get('artiste.service'),
            $c->get('style.service'),
            $c->get('lieu.service')
        );
    },

    'commande.provider' => function (ContainerInterface $c) {
        return new ProviderCommande(
            $c->get('billet.service'),
            $c->get('panier.service'),
            $c->get('commande.service')
        );
    },

];