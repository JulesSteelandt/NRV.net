<?php

namespace nrv\catalogue\domain\service\commande;


use nrv\catalogue\domain\entities\commande\Billet;

class ServiceBillet
{

    public function getBilletByUser(string $email): array
    {
        var_dump(Billet::where('mailUser', $email)->get()->toArray());
        return Billet::where('mailUser', $email)->get()->toArray();
    }

    public function getBilletByCommande(int $idCommande) {
        return Billet::where('idCommande', $idCommande)->get()->toArray();
    }

}