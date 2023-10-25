<?php

namespace nrv\catalogue\domain\exception;

class SpectacleIdException extends \Exception
{


    public function __construct(string $id)
    {
        parent::__construct("Le Spectacle $id n'existe pas");
    }
}