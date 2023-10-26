<?php

namespace nrv\catalogue\domain\dto\catalogue;

use nrv\catalogue\domain\dto\DTO;

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