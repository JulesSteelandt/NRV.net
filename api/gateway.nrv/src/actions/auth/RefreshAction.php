<?php

namespace nrv\gateway\actions\auth;

use nrv\gateway\actions\AbstractAction;
use nrv\gateway\provider\provider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RefreshAction extends AbstractAction
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $headers = $request->getHeaders();

        $catalogueData = $this->provider->refresh($headers);

        if ($catalogueData !== null) {
            $response->getBody()->write($catalogueData);
            return $response
                ->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        } else {
            // Gérer les erreurs de requête ici
            return $response
                ->withStatus(500); // Code d'erreur interne du serveur (à adapter en fonction de votre gestion d'erreurs)
        }
    }
}