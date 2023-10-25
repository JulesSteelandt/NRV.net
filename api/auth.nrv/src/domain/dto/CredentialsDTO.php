<?php

namespace nrv\auth\domain\dto;

class CredentialsDTO extends DTO {

    public string $email;
    public string $password;
    public string $nom;
    public string $prenom;

    /**
     * @param string $email
     * @param string $password
     * @param string $nom
     * @param string $prenom
     */
    public function __construct(string $email = '', string $password = '', string $nom = '', string $prenom = '') {
        $this->email = $email;
        $this->password = $password;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }
}