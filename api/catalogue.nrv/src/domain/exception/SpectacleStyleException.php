<?php

namespace nrv\catalogue\domain\exception;

class SpectacleStyleException extends \Exception
{


    public function __construct(string $style)
    {
        parent::__construct("Le style $style n'existe pas");
    }
}