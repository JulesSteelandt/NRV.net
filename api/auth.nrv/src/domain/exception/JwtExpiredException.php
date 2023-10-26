<?php

namespace nrv\auth\domain\exception;

use Exception;

class JwtExpiredException extends Exception {
    public function __construct() {
        parent::__construct('le token fourni est expiré');
    }

}