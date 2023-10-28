<?php

namespace nrv\catalogue\domain\exception;

class BilletRefException extends \Exception{

    public function __construct(string $id) {
        parent::__construct("le billet avec la ref $id n'existe pas",404);
    }
}