<?php

namespace nrv\auth\domain\service;

use Monolog\Logger;
use nrv\auth\app\auth\managers\JwtManager;
use nrv\auth\app\auth\providers\AuthProvider;
use nrv\auth\domain\dto\CredentialsDTO;
use nrv\auth\domain\dto\TokenDTO;
use nrv\auth\domain\dto\userDTO;
use Psr\Log\LoggerInterface;

class AuthService implements AuthServiceInterface {
    private JwtManager $jwtManager;
    private AuthProvider $authProvider;

    public function __construct( JwtManager $jwtManager, AuthProvider $authProvider) {
        $this->jwtManager = $jwtManager;
        $this->authProvider = $authProvider;
    }

    public function signup(CredentialsDTO $credentialsDTO): UserDTO {
        $this->authProvider->register($credentialsDTO->email, $credentialsDTO->mdp, $credentialsDTO->nom, $credentialsDTO->prenom);
        $us = $this->authProvider->getAuthenticatedUser();
        return new UserDTO($us['email'], $us['nom'], $us['prenom'], $us['typeUtil']);
    }

    public function signin(CredentialsDTO $credentialsDTO): TokenDTO {
        $this->authProvider->checkCredentials($credentialsDTO->email,$credentialsDTO->mdp);
        return $this->authProvider->genToken($this->authProvider->getUser($credentialsDTO->email,''), $this->jwtManager);    }

    public function validate(TokenDTO $tokenDTO): UserDTO {
            $payload = $this->jwtManager->validate($tokenDTO->jwt);
        return new UserDTO($payload->upr->email, $payload->upr->nom, $payload->upr->prenom, $payload->upr->typeUtil);

    }

    public function refresh(TokenDTO $tokenDTO): TokenDTO {

        $payload = $this->jwtManager->validate($tokenDTO->jwt);
        $this->authProvider->checkToken($payload->upr->refresh_token);
        return $this->authProvider->genToken($this->authProvider->getUser($payload->upr->email, $payload->upr->refresh_token), $this->jwtManager);
    }
}