<?php

namespace nrv\auth\domain\exception;

class RefreshUtilisateurException extends \Exception{

    public function __construct() {
        parent::__construct('Refresh Erreur : impossible de se reconnecter avec le refresh token');

    }
}