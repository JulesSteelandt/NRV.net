<?php

namespace nrv\catalogue\domain\exception;

class StyleIdException extends \Exception
{


    public function __construct(int $id)
    {
        parent::__construct("Le style $id n'existe pas");
    }
}