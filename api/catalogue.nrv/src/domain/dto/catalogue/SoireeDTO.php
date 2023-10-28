<?php

namespace nrv\catalogue\domain\dto\catalogue;
use nrv\catalogue\domain\dto\DTO;

use DateTime;

class SoireeDTO extends DTO
{

    public int $id, $idLieu;
    public string $nom, $theme;
    public float $tarifNormal, $tarifReduit;
    public DateTime $date, $horaire;

    /**
     * @param int $id
     * @param int $idLieu
     * @param string $nom
     * @param string $theme
     * @param float $tarifNormal
     * @param float $tarifReduit
     * @param DateTime $date
     * @param DateTime $horaire
     */
    public function __construct(int $id, int $idLieu, string $nom, string $theme, float $tarifNormal, float $tarifReduit, DateTime $date, DateTime $horaire)
    {
        $this->id = $id;
        $this->idLieu = $idLieu;
        $this->nom = $nom;
        $this->theme = $theme;
        $this->tarifNormal = $tarifNormal;
        $this->tarifReduit = $tarifReduit;
        $this->date = $date;
        $this->horaire = $horaire;
    }


}