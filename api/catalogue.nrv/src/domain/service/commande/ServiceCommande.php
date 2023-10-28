<?php

namespace nrv\catalogue\domain\service\commande;

use nrv\catalogue\domain\dto\commande\CommandeDTO;
use nrv\catalogue\domain\entities\catalogue\Lieu;
use nrv\catalogue\domain\entities\commande\Commande;
use nrv\catalogue\domain\exception\CommandeNombrePlaceException;

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

    public function payerCommande(string $email) {
        //where mailUser= $email et statut = 2
        $commande = Commande::where('mailUser', $email)->where('statut', 2)->firstOrFail();
        //calcul du nombre de place disponible à la soirée
        //on récupère la soirée
        $soiree = $commande->soiree;
        //on récupère le nombre de place disponible total à la soirée grace à son lieu
        var_dump($soiree);
        $lieuSoire = Lieu::where('id', $soiree->idLieu)->firstOrFail();
        $nbPlace = $lieuSoire->nbPlace;

        //on récupère le nombre de place déjà vendu à la soirée
        $nbPlaceVendu = 0;
        foreach ($soiree->commande as $commandeS) {
            if ($commandeS->statut == 3) {
                $nbPlaceVendu += $commandeS->pivot->nmbPlace;
            }
        }
        $nbPlaceDispo = $nbPlace - $nbPlaceVendu;
        if (!($nbPlaceDispo > $commande->pivot->nmbPlace)) {
            throw new CommandeNombrePlaceException();
        }
        $commande->statut = 3; // 3 = payé (1 = cree, 2 = validé, 3 = payé)
        $commande->save();
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