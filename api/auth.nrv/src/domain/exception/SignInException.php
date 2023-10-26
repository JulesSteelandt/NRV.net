<?php

namespace nrv\auth\domain\exception;

class SignInException extends \Exception {

    public function __construct() {
        parent::__construct('Erreur SignIn : erreur lors de la connexion');
    }
}