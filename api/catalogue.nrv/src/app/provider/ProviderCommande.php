<?php

namespace nrv\catalogue\app\provider;

use nrv\catalogue\domain\dto\commande\BilletDTO;
use nrv\catalogue\domain\exception\BilletRefException;
use nrv\catalogue\domain\exception\CommandeNombrePlaceException;
use nrv\catalogue\domain\exception\CommandeStatutException;
use nrv\catalogue\domain\service\commande\ServiceBillet;
use nrv\catalogue\domain\service\commande\ServiceCommande;
use nrv\catalogue\domain\service\commande\ServicePanier;

class ProviderCommande
{

    public ServiceBillet $serviceBillet;
    public ServiceCommande $serviceCommande;
    public ServicePanier $servicePanier;

    /**
     * @param ServiceBillet $serviceBillet
     */
    public function __construct(ServiceBillet $serviceBillet, ServicePanier $servicePanier, ServiceCommande $serviceCommande)
    {
        $this->serviceBillet = $serviceBillet;
        $this->servicePanier = $servicePanier;
        $this->serviceCommande = $serviceCommande;
    }

    public function getBilletUser(string $email): array
    {
        $b = $this->serviceBillet->getBilletByUser($email);
        if ($b != null) {
            return $b;
        } else {
            return ['cet utilisateur n\'a pas de billet'];
        }
    }

    /**
     * @throws BilletRefException
     */
    public function getBilletRef(string $ref): BilletDTO
    {
        return $this->serviceBillet->getBilletByRef($ref);
    }

    /**
     * @throws CommandeStatutException
     * @throws CommandeNombrePlaceException
     * @throws BilletRefException
     */
    public function payerCommandeUser(int $idCommande): array
    {
        $commandedto = $this->serviceCommande->getCommandeById($idCommande);
        $soirees = $this->serviceCommande->payerCommande($commandedto->idCommande);
        $billets = [];
        foreach ($soirees['soirees'] as $soiree) {
            for ($i = 0; $i < $soiree->nbPlace; $i++) {
                $billets[] = $this->serviceBillet->creerBillet($soiree, $soirees['user']);
            }
        }

        return $billets;
    }

}