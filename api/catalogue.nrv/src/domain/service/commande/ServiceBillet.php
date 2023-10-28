<?php

namespace nrv\catalogue\domain\service\commande;


use nrv\catalogue\domain\dto\catalogue\SoireeDTO;
use nrv\catalogue\domain\entities\commande\Billet;
use Ramsey\Uuid\Uuid;

class ServiceBillet
{

    public function getBilletByUser(string $email): array
    {
        var_dump(Billet::where('mailUser', $email)->get()->toArray());
        return Billet::where('mailUser', $email)->get()->toArray();
    }

    public function getBilletByCommande(int $idCommande)
    {
        return Billet::where('idCommande', $idCommande)->get()->toArray();
    }

    public function creerBillet(SoireeDTO $s, string $user)
    {
        $billet = new Billet();
        $ref = Uuid::uuid4();
        $billet->reference = $ref;
        $billet->idSoiree = $s->id;
        $billet->mailUser = $user;
        $billet->date = $s->date;
        $billet->horaire = $s->horaire;
        if ($s->typeTarif == 1) {
            $billet->catTarif = "Prix plein";
        } else {
            $billet->catTarif = "Prix réduit";
        }
        $billet->save();

        return $this->getBilletByRef($ref);
    }

    public function getBilletByRef(string $ref)
    {
        return Billet::find($ref)->toDTO();
    }

}