<?php

namespace nrv\catalogue\app\actions;

use nrv\catalogue\app\provider\Provider;
use nrv\catalogue\domain\exception\SoireeIdException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeIdAction extends AbstractAction
{

    private Provider $provider;


    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        try {
            $soiree = $this->provider->getSoireeById($args['id']);
        } catch (SoireeIdException $e) {
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
        $data['soiree']['data'] = $soiree['soiree'];
        $data['soiree']['links']['spectacles'] = ['count' => count($soiree['spectacles'])];
        foreach ($soiree['spectacles'] as $spectacle){
            $data['soiree']['links']['spectacles'][] = ['/spectale/'.$spectacle];
        }


        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}