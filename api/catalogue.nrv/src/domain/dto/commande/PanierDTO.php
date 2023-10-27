<?php

namespace nrv\catalogue\domain\dto\commande;

use nrv\catalogue\domain\dto\DTO;
class PanierDTO extends DTO {

    public String $mailUser;
    public int $idSoiree, $nmbPlace, $typeTarif;

    public function __construct(String $mailUser, int $idSoiree, int $nmbPlace, int $typeTarif)
    {
        $this->mailUser = $mailUser;
        $this->idSoiree = $idSoiree;
        $this->nmbPlace = $nmbPlace;
        $this->typeTarif = $typeTarif;
    }

}