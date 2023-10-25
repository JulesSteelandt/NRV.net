<?php

namespace nrv\gateway\provider;

use nrv\gateway\client\CatalogueClient;

class Provider
{

    private CatalogueClient $catalogueClient;

    /**
     * @param CatalogueClient $catalogueClient
     */
    public function __construct(CatalogueClient $catalogueClient)
    {
        $this->catalogueClient = $catalogueClient;
    }

    public function catalogue(){
        return $this->catalogueClient->get("/programme");
    }


}