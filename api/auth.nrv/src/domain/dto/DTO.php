<?php

namespace nrv\auth\domain\dto;

abstract class DTO {
    public function toJSON(): string {
        return json_encode($this, JSON_PRETTY_PRINT);
    }
}