<?php

namespace dto;

use dto\DTO;

class TokenDTO extends DTO {
    public string $refreshToken;
    public string $jwt;

    /**
     * @param string $refreshToken
     * @param string $jwt
     * @param string $activationToken
     */
    public function __construct(string $refreshToken = '', string $jwt = '') {
        $this->refreshToken = $refreshToken;
        $this->jwt = $jwt;
    }
}