<?php

namespace nrv\catalogue\domain\service\commande;


use nrv\catalogue\domain\dto\catalogue\StyleDTO;
use nrv\catalogue\domain\entities\catalogue\Style;
use nrv\catalogue\domain\entities\commande\Billet;
use nrv\catalogue\domain\entities\commande\Panier;
use nrv\catalogue\domain\exception\StyleIdException;

class ServiceBillet
{

    public function getBilletByUser(string $email): array
    {
        var_dump(Billet::where('mailUser', $email)->get()->toArray());
        return Billet::where('mailUser', $email)->get()->toArray();
    }

}