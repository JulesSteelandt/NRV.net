<?php

namespace nrv\catalogue\app\actions\commande;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCommande;
use nrv\catalogue\domain\exception\BilletRefException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetBilletByRefAction extends AbstractAction
{

    private ProviderCommande $provider;


    public function __construct(ProviderCommande $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        try {
            $billet = $this->provider->getBilletRef($args['id']);

            $data['type'] = 'resource';
            $data['data'] = [
                'reference' => $billet->reference,
                'auteur' => $billet->mailUser,
                'catTarif' => $billet->catTarif,
                'date' => $billet->date->format('Y-m-d'),
                'horaireDebut' => $billet->horaire->format('H:i:s')
                ];
        }catch (BilletRefException $e){
            $data = array(
                "message" => "404 Not Found",
                "exception" => array(
                    "type" => $e::class,
                    "code" => $e->getCode(),
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine()
                ));
        }

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}