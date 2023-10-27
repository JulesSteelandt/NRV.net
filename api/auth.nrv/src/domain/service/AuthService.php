<?php

namespace nrv\auth\domain\service;

use nrv\auth\app\auth\managers\JwtManager;
use nrv\auth\app\auth\providers\AuthProvider;
use nrv\auth\domain\dto\CredentialsDTO;
use nrv\auth\domain\dto\TokenDTO;
use nrv\auth\domain\dto\userDTO;
use nrv\auth\domain\exception\CredentialsException;
use nrv\auth\domain\exception\EmailFormatException;
use nrv\auth\domain\exception\JwtExpiredException;
use nrv\auth\domain\exception\JwtInvalidException;
use nrv\auth\domain\exception\RefreshTokenInvalideException;
use nrv\auth\domain\exception\RefreshUtilisateurException;
use nrv\auth\domain\exception\RegisterExistException;
use nrv\auth\domain\exception\RegisterValueException;
use nrv\auth\domain\exception\SignInException;

class AuthService implements AuthServiceInterface {
    private JwtManager $jwtManager;
    private AuthProvider $authProvider;

    public function __construct( JwtManager $jwtManager, AuthProvider $authProvider) {
        $this->jwtManager = $jwtManager;
        $this->authProvider = $authProvider;
    }

    /**
     * @throws RegisterValueException
     * @throws RegisterExistException
     */
    public function signup(CredentialsDTO $credentialsDTO): UserDTO {
        //sanitize
        $email = filter_var($credentialsDTO->email, FILTER_SANITIZE_EMAIL);
        //validate
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new EmailFormatException();
        }

        $nom = filter_var($credentialsDTO->nom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z]+$/")));
        $prenom = filter_var($credentialsDTO->prenom, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z]+$/")));


        $this->authProvider->register($email, $credentialsDTO->mdp, $nom, $prenom);
        $us = $this->authProvider->getAuthenticatedUser($credentialsDTO->email);
        return new UserDTO($us['email'], $us['nom'], $us['prenom'], $us['typeUtil']);
    }

    /**
     * @throws CredentialsException
     * @throws SignInException
     * @throws RefreshUtilisateurException
     */
    public function signin(CredentialsDTO $credentialsDTO): TokenDTO {
        $email = filter_var($credentialsDTO->email, FILTER_SANITIZE_EMAIL);
        //validate
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new EmailFormatException();
        }

        $this->authProvider->checkCredentials($email,$credentialsDTO->mdp);
        return $this->authProvider->genToken($this->authProvider->getUser($credentialsDTO->email,''), $this->jwtManager);    }

    /**
     * @throws JwtInvalidException
     * @throws JwtExpiredException
     */
    public function validate(TokenDTO $tokenDTO): UserDTO {
            $payload = $this->jwtManager->validate($tokenDTO->jwt);
            return new UserDTO($payload->upr->email, $payload->upr->nom, $payload->upr->prenom, $payload->upr->typeUtil);
    }

    /**
     * @throws RefreshTokenInvalideException
     * @throws RefreshUtilisateurException
     * @throws SignInException
     */
    public function refresh(TokenDTO $tokenDTO): TokenDTO {
        $this->authProvider->checkToken($tokenDTO->refreshToken);
        return $this->authProvider->genToken($this->authProvider->getUser('',$tokenDTO->refreshToken), $this->jwtManager);
    }
}