<?php

namespace nrv\catalogue\domain\service\commande;


use nrv\catalogue\domain\dto\catalogue\StyleDTO;
use nrv\catalogue\domain\entities\catalogue\Style;
use nrv\catalogue\domain\entities\commande\Billet;
use nrv\catalogue\domain\exception\StyleIdException;

class ServiceBillet
{

    public function getBilletByUser(string $email): array
    {
        return Billet::where('mailUser', $email)->get()->toArray();
    }

}