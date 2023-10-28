<?php

namespace nrv\catalogue\domain\exception;

class CommandeStatutException extends \Exception{

    public function __construct() {
        parent::__construct("Cet commande n'est pas validé ou a déjà été payé",404);
    }
}