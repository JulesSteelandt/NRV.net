<?php

namespace nrv\gateway\provider;

use nrv\gateway\client\ClientApi;

class Provider
{

    private ClientApi $clientApi;


    public function __construct(ClientApi $clientApi)
    {
        $this->clientApi = $clientApi;
    }

    public function catalogue(){
        return $this->clientApi->get("/programme");
    }

    public function spectacle($id){
        return $this->clientApi->get("/spectacle/$id");
    }

    public function soiree($id){
        return $this->clientApi->get("/soiree/$id");
    }

    public function artiste($id){
        return $this->clientApi->get("/artiste/$id");
    }

    public function style(){
        return $this->clientApi->get("/style");
    }

    public function styleId($id){
        return $this->clientApi->get("/style/$id");
    }





}