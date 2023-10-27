<?php

namespace nrv\catalogue\domain\exception;

class CommandeNombrePlaceException extends \Exception{

    public function __construct() {
        parent::__construct("Nombre de places restantes insuffisant");
    }
}