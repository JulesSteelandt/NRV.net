<?php

namespace nrv\catalogue\app\actions\catalogue;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCatalogue;
use nrv\catalogue\domain\exception\LieuIdException;
use nrv\catalogue\domain\exception\SoireeIdException;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\exception\StyleIdException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetProgrammeAction extends AbstractAction
{

    private ProviderCatalogue $provider;


    public function __construct(ProviderCatalogue $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        $params = $request->getQueryParams();



        try {
            $catalogue = $this->provider->getProgramme();
            if (isset($params['style'])){
                $catalogue = $this->provider->getProgramme('style',$params['style']);
            }
            if (isset($params['date'])){
                $catalogue = $this->provider->getProgramme('date',$params['date']);
            }
            if (isset($params['lieu'])){
                $catalogue = $this->provider->getProgramme('lieu',$params['lieu']);
            }

        } catch (SpectacleIdException|SoireeIdException|LieuIdException|StyleIdException $e) {
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
        $data['count'] = count($catalogue);

        foreach ($catalogue as $programme){
            $data['data'][] = [
                'spectacle'=>[
                    'id'=>$programme['spectacle']->id,
                    'titre'=>$programme['spectacle']->titre,
                    'date'=>$programme['soiree']->date->format('Y-m-d'),
                    'horaire'=>$programme['horaire']->format('H:i:s'),
                    'image'=>$programme['image'],
                    'idSoiree'=>$programme['soiree']->id,
                    'links' => [
                        'self' => [
                            'href' => '/spectacle/' . $programme['spectacle']->id,
                        ],
                        'soiree' => [
                            'href' => '/soiree/' . $programme['soiree']->id,
                        ],
                    ],
                ],
            ];
        }

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}