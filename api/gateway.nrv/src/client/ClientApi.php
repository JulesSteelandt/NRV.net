<?php

namespace nrv\gateway\client;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;

class ClientApi
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

            $responseData = json_decode($jsonContents, true);

            return json_encode($responseData, JSON_PRETTY_PRINT);

        } catch (GuzzleException|RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();

                $body = $response->getBody()->getContents();
                $response = json_decode($body, JSON_PRETTY_PRINT);

                return json_encode($response, JSON_PRETTY_PRINT);

            } else {
                echo "Erreur de communication : " . $e->getMessage();
            }
        }
    }


}