<?php

namespace nrv\catalogue\domain\dto;

abstract class DTO
{
    public function toJSON(): string {
        return json_encode($this, JSON_PRETTY_PRINT);
    }

}