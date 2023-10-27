<?php

namespace nrv\catalogue\app\actions\commande;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCommande;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetPanierByUserAction extends AbstractAction
{

    private ProviderCommande $provider;


    public function __construct(ProviderCommande $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $panier = $this->provider->getPanierByUser($args['mail']);

        $data['type'] = 'resource';
        $data['data']= $panier;

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}