<?php

namespace nrv\auth\domain\exception;

class RegisterExistException extends \Exception{

    public function __construct() {
        parent::__construct('Erreur Register : erreur lors de l\'inscription un compte existe déjà avec cette adresse mail');
    }
}