<?php

namespace nrv\catalogue\domain\dto;


use DateTime;

class CatalogueDTO extends DTO
{

    public int $idSoiree, $idSpectacle;
    public DateTime $horaireSpectacle;

    /**
     * @param int $idSoiree
     * @param int $idSpectacle
     * @param DateTime $horaireSpectacle
     */
    public function __construct(int $idSoiree, int $idSpectacle, DateTime $horaireSpectacle)
    {
        $this->idSoiree = $idSoiree;
        $this->idSpectacle = $idSpectacle;
        $this->horaireSpectacle = $horaireSpectacle;
    }


}