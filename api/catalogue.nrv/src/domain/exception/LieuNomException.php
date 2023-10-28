<?php

namespace nrv\catalogue\domain\exception;

class LieuNomException extends \Exception
{
    public function __construct(string $id)
    {
        parent::__construct("Le lieu $id n'existe pas",404);
    }
}