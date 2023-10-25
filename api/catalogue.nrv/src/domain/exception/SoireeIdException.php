<?php

namespace nrv\catalogue\domain\exception;

class SoireeIdException extends \Exception
{


    public function __construct(string $id)
    {
        parent::__construct("La soiree $id n'existe pas");
    }
}