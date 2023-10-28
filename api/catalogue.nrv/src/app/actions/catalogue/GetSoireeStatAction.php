<?php

namespace nrv\catalogue\app\actions\catalogue;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCatalogue;
use nrv\catalogue\domain\exception\SoireeIdException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeStatAction extends AbstractAction
{

    private ProviderCatalogue $provider;


    public function __construct(ProviderCatalogue $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $stat = $this->provider->getStat();
        $data['type'] = 'resource';
        $data['data'] = $stat;

        $response->getBody()->write(json_encode($data));
        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);

    }
}