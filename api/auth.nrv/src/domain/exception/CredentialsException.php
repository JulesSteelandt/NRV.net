<?php

namespace nrv\auth\domain\exception;

class CredentialsException extends \Exception {
    public function __construct() {
        parent::__construct('Erreur SignIn : le mail ou le mot de passe est incorrect');
    }
}