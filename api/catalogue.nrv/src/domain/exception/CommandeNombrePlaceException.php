<?php

namespace nrv\catalogue\domain\exception;

class CommandeNombrePlaceException extends \Exception{

    public function __construct(int $id) {
        parent::__construct("Nombre de places restantes insuffisant pour la soirée $id",404);
    }
}