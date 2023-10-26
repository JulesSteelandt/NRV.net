<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

session_start();
// crée l'app et le moteur de templates

$builder = new ContainerBuilder();

$builder->addDefinitions(
    include('dependencies/services_dependencies.php'),
    include('dependencies/action_dependencies.php')
);

$c = $builder->build();

$app = AppFactory::createFromContainer($c);
$container = $app->getContainer();


// ajoute le routing et l'erreur middleware
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);
$app->setBasePath('');

return $app;
