<?php

namespace nrv\auth\domain\dto;

class userDTO extends DTO {


    public string $email;

    public string $nom;
    public string $prenom;
    public int $typeUtil;

    /**
     * @param string $email
     * @param string $nom
     * @param String $prenom
     * @param int $typeUtil
     */
    public function __construct(string $email, string $nom, string $prenom, int $typeUtil) {
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->typeUtil = $typeUtil;
    }
}