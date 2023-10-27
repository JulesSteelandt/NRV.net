<?php

namespace nrv\catalogue\app\provider;


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
    public function __construct(ServiceBillet $serviceBillet, ServicePanier $servicePanier, ServiceCommande $serviceCommande )
    {
        $this->serviceBillet = $serviceBillet;
        $this->servicePanier = $servicePanier;
        $this->serviceCommande = $serviceCommande;
    }

    public function getBilletUser(string $email):array{
        $b = $this->serviceBillet->getBilletByUser($email);
        if ($b!=null){
            return $b;
        }else{
            return ['cet utilisateur n\'a pas de billet'];
        }
    }

    public function getPanierByUser(string $email):array{
        $b = $this->servicePanier->getPanierByUser($email);
        var_dump($b);
        if ($b!=null){
            return $b;
        }else{
            return ['Aucune soirée'];
        }
    }


    public function payerCommandeUser(int $idCommande):array {
       $commandedto =  $this->serviceCommande->getCommandeById($idCommande);
        $this->serviceCommande->payerCommande($commandedto->mailUser);
        //return les billets de la commande
        return $this->serviceBillet->getBilletByCommande($idCommande);
    }

}