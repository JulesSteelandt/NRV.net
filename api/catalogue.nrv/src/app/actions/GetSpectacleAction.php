<?php

namespace nrv\catalogue\app\actions;

use nrv\catalogue\app\provider\Provider;
use nrv\catalogue\domain\exception\SoireeIdException;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\exception\StyleIdException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSpectacleAction extends AbstractAction
{

    private Provider $provider;


    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        try {
            $spectacle = $this->provider->getSpectacleById($args['id']);
        } catch (SpectacleIdException|StyleIdException $e) {
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
        $data['data'] = ['spectacles' => [
            'id'=>$spectacle['spectacle']->id,
            'style'=>$spectacle['style'],
            'titre'=>$spectacle['spectacle']->titre,
            'description'=>$spectacle['spectacle']->description,
            'urlvideo'=>$spectacle['spectacle']->urlVideo,
            'artistes'=> [
                'count' => count($spectacle['artistes']),
                'list'=>$spectacle['artistes'],
            ],
    ]];


        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}