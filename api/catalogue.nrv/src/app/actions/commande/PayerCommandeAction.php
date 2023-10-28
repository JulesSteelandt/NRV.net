<?php

namespace nrv\catalogue\app\actions\commande;

use Exception;
use nrv\catalogue\app\actions\AbstractAction;
use nrv\catalogue\app\provider\ProviderCommande;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PayerCommandeAction extends AbstractAction {

    private ProviderCommande $provider;

    /**
     * @param ProviderCommande $provider
     */
    public function __construct(ProviderCommande $provider) {
        $this->provider = $provider;
    }


    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface {

        if (isset($args['id'])) {
            try {
                $idcommande = $args['id'];
                $billets = $this->provider->payerCommandeUser($idcommande);
                //return $billets;
                $data['type'] = 'resource';
                foreach ($billets as $billet) {
                    $data['data']['billets'][] = [
                        'reference' => $billet->reference,
                        'auteur' => $billet->mailUser,
                        'catTarif' => $billet->catTarif,
                        'date' => $billet->date->format('Y-m-d'),
                        'horaireDebut' => $billet->horaire->format('H:i:s'),
                    ];
                }
                $response->getBody()->write(json_encode($data));
                $response = $response->withStatus(200)->withHeader('Content-Type', 'application/json');
            } catch (Exception $e) {
                $responseMessage = array(
                    "message" => "400 paiement failed",
                    "exception" => array(
                        "type" => $e::class,
                        "code" => $e->getCode(),
                        "message" => $e->getMessage(),
                        "file" => $e->getFile(),
                        "line" => $e->getLine()
                    )
                );
                $response->getBody()->write(json_encode($responseMessage));
                $response = $response->withStatus(400)->withHeader('Content-Type', 'application/json');
            }
        }
        return $response;
    }

}