<?php

namespace nrv\catalogue\domain\exception;

class ArtisteIdException extends \Exception
{


    public function __construct(int $id)
    {
        parent::__construct("L'artiste $id n'existe pas");
    }
}