<?php

namespace nrv\catalogue\domain\dto\catalogue;
use nrv\catalogue\domain\dto\DTO;


class LieuDTO extends DTO
{

    public int $id, $nbPlace, $nbPlaceAssis, $nbPlaceDebout;
    public string $nom, $adresse;
    public ?string $image;

    /**
     * @param int $id
     * @param int $nbPlace
     * @param int $nbPlaceAssis
     * @param int $nbPlaceDebout
     * @param string $nom
     * @param string $adresse
     */
    public function __construct(int $id, int $nbPlace, int $nbPlaceAssis, int $nbPlaceDebout, string $nom, string $adresse, ?string $image = null)
    {
        $this->id = $id;
        $this->nbPlace = $nbPlace;
        $this->nbPlaceAssis = $nbPlaceAssis;
        $this->nbPlaceDebout = $nbPlaceDebout;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->image = $image;
    }


}