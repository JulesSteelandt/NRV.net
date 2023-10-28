<?php

namespace nrv\catalogue\domain\exception;

class SpectacleIdException extends \Exception
{


    public function __construct(int $id)
    {
        parent::__construct("Le Spectacle $id n'existe pas",404);
    }
}