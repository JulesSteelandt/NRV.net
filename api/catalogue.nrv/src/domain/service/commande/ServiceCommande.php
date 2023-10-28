<?php

namespace nrv\catalogue\domain\service\commande;

use nrv\catalogue\domain\dto\commande\CommandeDTO;
use nrv\catalogue\domain\entities\catalogue\Lieu;
use nrv\catalogue\domain\entities\commande\Commande;
use nrv\catalogue\domain\exception\CommandeNombrePlaceException;
use nrv\catalogue\domain\exception\CommandeStatutException;

class ServiceCommande {

    public function getCommandeByUser(string $email): array {
        return Commande::where('mailUser', $email)->get()->toArray();
    }

    public function getCommandeById(string $id) : CommandeDTO {
        $commande = Commande::where('idCommande', $id)->firstOrFail();
        return $commande->toDTO();
    }

    public function validerCommande(string $email) {
        //where mailUser= $email et statut = 1
        $commande = Commande::where('mailUser', $email)->where('statut', 1)->firstOrFail();
        $commande->statut = 2; // 2 = validé (1 = cree, 2 = validé, 3 = payé)
        $commande->save();

    }

    public function payerCommande(int $id) {
        //where mailUser= $email et statut = 2
        $commande = Commande::find($id);
        if ($commande->statut != 2){
            throw new CommandeStatutException();
        }
        //calcul du nombre de place disponible à la soirée
        //on récupère la/les soirée(s)
        $soirees = $commande->soiree;
        $list['user'] = $commande->mailUser;
        $nbPlace = [];
        foreach ($soirees as $soiree){
            $list['soirees'][] = $soiree->toDTO($soiree->pivot->nmbPlace,$soiree->pivot->typeTarif);
            $nbPlace[$soiree->id] = $soiree->nbPlaceRestante;
        }


        foreach ($nbPlace as $key => $check){
            if ($check == 0){
                throw new CommandeNombrePlaceException($key);
            }
        }

        $commande->statut = 3; // 3 = payé (1 = cree, 2 = validé, 3 = payé)
        $commande->save();
        return $list;
    }
    public function creerCommande(string $email, float $total){
        $commande = new Commande();
        $commande->idCommande = uniqid();
        $commande->statut = 1;
        $commande->mailUser = $email;
        $commande->total = $total;
        $commande->save();
        return $commande->idCommande;
    }

}