<?php

namespace nrv\catalogue\domain\dto\commande;

use DateTime;
use nrv\catalogue\domain\dto\DTO;
class BilletDTO extends DTO {

public String $reference, $mailUser, $catTarif;
public int $idSoiree;
public DateTime $date, $horaire;

    public function __construct(String $reference, int $idSoiree, String $mailUser, DateTime $date, DateTime $horaire, String $catTarif)
    {
        $this->reference = $reference;
        $this->idSoiree = $idSoiree;
        $this->mailUser = $mailUser;
        $this->date = $date;
        $this->horaire = $horaire;
        $this->catTarif = $catTarif;
    }
}