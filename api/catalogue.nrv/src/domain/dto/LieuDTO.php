<?php

namespace nrv\catalogue\domain\dto;


class LieuDTO extends DTO
{

    public int $id, $nbPlace, $nbPlaceAssis, $nbPlaceDebout;
    public string $nom, $adresse;

    /**
     * @param int $id
     * @param int $nbPlace
     * @param int $nbPlaceAssis
     * @param int $nbPlaceDebout
     * @param string $nom
     * @param string $adresse
     */
    public function __construct(int $id, int $nbPlace, int $nbPlaceAssis, int $nbPlaceDebout, string $nom, string $adresse)
    {
        $this->id = $id;
        $this->nbPlace = $nbPlace;
        $this->nbPlaceAssis = $nbPlaceAssis;
        $this->nbPlaceDebout = $nbPlaceDebout;
        $this->nom = $nom;
        $this->adresse = $adresse;
    }


}