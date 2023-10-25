<?php

namespace nrv\catalogue\app\actions;

use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\service\ServiceCatalogue;
use nrv\catalogue\domain\service\ServiceSpectacle;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class GetCatalogueAction extends AbstractAction
{

    private ServiceCatalogue $serviceCatalogue;


    public function __construct(ServiceCatalogue $serviceCatalogue)
    {
        $this->serviceCatalogue = $serviceCatalogue;
    }

    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {

        try {
            $catalaogue = $this->serviceCatalogue->getCatalogue();
        } catch (SpectacleIdException $e) {
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



        $data = [
            'type' => 'resource',
            'commande' => $commande,
            'links' => [
                'self' => [
                    'href' => '/commandes/' . $commande->id,
                ],
                'valider' => [
                    'href' => '/commandes/' . $commande->id,
                ],
            ],
        ];

        $response->getBody()->write(json_encode($data));
        return
            $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
    }
}