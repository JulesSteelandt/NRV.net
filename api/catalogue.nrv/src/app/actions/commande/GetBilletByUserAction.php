<?php

namespace nrv\catalogue\app\actions\commande;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCommande;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetBilletByUserAction extends AbstractAction
{

    private ProviderCommande $provider;


    public function __construct(ProviderCommande $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $billet = $this->provider->getBilletUser($args['mail']);

        $data['type'] = 'resource';
        $data['data']= $billet;

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}