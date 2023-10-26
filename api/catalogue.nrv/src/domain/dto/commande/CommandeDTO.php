<?php

namespace nrv\catalogue\domain\dto\commande;

use nrv\catalogue\domain\dto\DTO;
class CommandeDTO extends DTO {

    public int $idCommande, $statut;
    public string $mailUser;
    public float $total;

    public function __construct(int $idCommande, string $mailUser, int $statut, float $total)
    {
        $this->idCommande = $idCommande;
        $this->mailUser = $mailUser;
        $this->statut = $statut;
        $this->total = $total;
    }

}