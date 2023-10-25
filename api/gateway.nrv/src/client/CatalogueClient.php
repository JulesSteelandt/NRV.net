<?php

namespace nrv\gateway\client;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class CatalogueClient
{

    protected Client $client;

    public function __construct(array $config = [])
    {
        $this->client = new Client($config);
    }

    public function get($url)
    {
        try {
            $response = $this->client->get($url);
            $jsonContents = $response->getBody()->getContents();

            // Décodez le JSON en un tableau associatif pour le reformater
            $responseData = json_decode($jsonContents, true);

            // Reformatte le tableau associatif en JSON lisible
            return json_encode($responseData, JSON_PRETTY_PRINT);

        } catch (GuzzleException $e) {
            // Gérer les erreurs de requête ici
            return null;
        }
    }


}