<?php

namespace nrv\gateway\actions\auth;

use nrv\gateway\actions\AbstractAction;
use nrv\gateway\provider\Provider;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SignInAction extends AbstractAction
{
    private Provider $provider;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        // Récupérez les en-têtes de la requête entrante
        $headers = $request->getHeaders();

        // Appelez la méthode de la classe Provider pour envoyer les en-têtes à l'API 2
        $responseData = $this->provider->signin($headers);

        if ($responseData !== null) {
            $response->getBody()->write($responseData);
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
