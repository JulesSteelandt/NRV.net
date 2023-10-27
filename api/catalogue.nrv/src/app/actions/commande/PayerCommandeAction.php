<?php

namespace nrv\catalogue\app\actions\commande;

use mysql_xdevapi\Exception;
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
        $data = $request->getParsedBody();
        if (isset($data['idCommande'])) {
            try {
                $idcommande = $data['idCommande'];
                $billets = $this->provider->payerCommandeUser($idcommande);
                //return $billets;
                $data['type'] = 'resource';
                $data['data'] = $billets;
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