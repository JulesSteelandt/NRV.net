<?php

namespace nrv\auth\domain\service;

use nrv\auth\domain\dto\CredentialsDTO;
use nrv\auth\domain\dto\TokenDTO;
use nrv\auth\domain\dto\userDTO;

interface AuthServiceInterface {
    public function signup(CredentialsDTO $credentialsDTO) : UserDTO;

    public function signin(CredentialsDTO $credentialsDTO) : TokenDTO;

    public function validate(TokenDTO $tokenDTO) : UserDTO;

    public function refresh(TokenDTO $tokenDTO) : TokenDTO;



}