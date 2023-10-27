<?php

namespace nrv\catalogue\domain\dto\catalogue;
use nrv\catalogue\domain\dto\DTO;


class ArtisteDTO extends DTO
{

    public int $id, $idSpectacle;
    public string $nom, $prenom;
    public ?string $pseudo;

    /**
     * @param int $id
     * @param int $idSpectacle
     * @param string $nom
     * @param string $prenom
     * @param string $pseudo
     */
    public function __construct(int $id, string $nom, string $prenom, ?string $pseudo, int $idSpectacle)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->pseudo = $pseudo;
        $this->idSpectacle = $idSpectacle;
    }


}