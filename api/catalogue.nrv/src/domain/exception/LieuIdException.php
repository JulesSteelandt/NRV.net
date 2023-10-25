<?php

namespace nrv\catalogue\domain\exception;

class LieuIdException extends \Exception
{
    public function __construct(int $id)
    {
        parent::__construct("Le lieu $id n'existe pas");
    }
}