<?php

namespace nrv\catalogue\domain\service\commande;


use nrv\catalogue\domain\entities\commande\Panier;

class ServicePanier
{

    public function getPanierByUser(string $email): array
    {
        $list = null;
        $panier = Panier::where('mailUser', $email)->get();
        var_dump($panier);
        foreach ($panier as $product){
            $list[] = $product->toDTO();
        }
        return $list;
    }

}