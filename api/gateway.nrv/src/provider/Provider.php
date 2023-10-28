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

    public function catalogue(string $params = ""){
        return $this->clientApi->get("/programme".$params);
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

    public function validate($headers){
        return $this->clientApi->get("/validate",null,$headers);
    }

    public function signin($headers)
    {
        return $this->clientApi->post("/signin", null,$headers);
    }

    public function signup($data){
        return $this->clientApi->post("/signup",$data);
    }

    public function refresh($data){
        return $this->clientApi->post("/refresh",null,$data);
    }

    public function billet($data){
        return $this->clientApi->get("/billet/$data");
    }

    public function lieu(){
        return $this->clientApi->get("/lieu");
    }

    public function soireeStat(){
        return $this->clientApi->get("/soiree/stat");
    }

    public function payer(int $id){
        return $this->clientApi->post("/payer/$id",null);
    }






}