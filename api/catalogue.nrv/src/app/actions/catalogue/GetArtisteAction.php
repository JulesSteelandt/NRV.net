<?php

namespace nrv\catalogue\app\actions\catalogue;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\Provider;
use nrv\catalogue\domain\exception\ArtisteIdException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetArtisteAction extends AbstractAction
{

    private Provider $provider;


    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        try {
            $artiste = $this->provider->getArtisteById($args['id']);
        } catch (ArtisteIdException $e) {
            $responseMessage = array(
                "message" => "404 Not Found",
                "exception" => array(
                    "type" => $e::class,
                    "code" => $e->getCode(),
                    "message" => $e->getMessage(),
                    "file" => $e->getFile(),
                    "line" => $e->getLine()
                ));

            $response->getBody()->write(json_encode($responseMessage));
            return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
        }

        $data['type'] = 'resource';
        $data['data']['artiste'] = $artiste;
        $data['data']['links'] = ['spectacle'=>'/spectacle/'.$artiste->idSpectacle];

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}