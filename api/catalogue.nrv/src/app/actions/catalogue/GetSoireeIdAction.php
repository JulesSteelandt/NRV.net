<?php

namespace nrv\catalogue\app\actions\catalogue;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCatalogue;
use nrv\catalogue\domain\exception\SoireeIdException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetSoireeIdAction extends AbstractAction
{

    private ProviderCatalogue $provider;


    public function __construct(ProviderCatalogue $provider)
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
        $data['data']['soiree'] = [
            'id' => $soiree['soiree']->id,
            'nom' => $soiree['soiree']->nom,
            'theme' => $soiree['soiree']->theme,
            'date' => $soiree['soiree']->date->format('Y-m-d'),
            'horaireDebut' => $soiree['soiree']->horaire->format('H:i:s'),
            'tarifNormal' => $soiree['soiree']->tarifNormal,
            'tarifReduit' => $soiree['soiree']->tarifReduit,
            'Lieu' => $soiree['lieu'],
        ];
        $data['data']['spectacle']['count'] = count($soiree['spectacles']);

foreach ($soiree['spectacles'] as $spectacle){
    $data['data']['spectacle'][] = [
                'id'=>$spectacle['spectacle']->id,
                'style'=>$spectacle['style'],
                'titre'=>$spectacle['spectacle']->titre,
                'description'=>$spectacle['spectacle']->description,
                'urlvideo'=>$spectacle['spectacle']->urlVideo,
                'artistes'=> [
                        'count' => count($spectacle['artistes']),
                        'list' => $spectacle['artistes'],
                ],
            ];
        }

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}