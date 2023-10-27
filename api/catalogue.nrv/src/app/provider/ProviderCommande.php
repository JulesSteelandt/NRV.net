<?php

namespace nrv\catalogue\app\provider;

use nrv\catalogue\domain\dto\ArtisteDTO;
use nrv\catalogue\domain\dto\StyleDTO;
use nrv\catalogue\domain\exception\ArtisteIdException;
use nrv\catalogue\domain\exception\LieuIdException;
use nrv\catalogue\domain\exception\SoireeIdException;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\exception\StyleIdException;
use nrv\catalogue\domain\service\catalogue\ServiceArtiste;
use nrv\catalogue\domain\service\catalogue\ServiceCatalogue;
use nrv\catalogue\domain\service\catalogue\ServiceLieu;
use nrv\catalogue\domain\service\catalogue\ServiceSoiree;
use nrv\catalogue\domain\service\catalogue\ServiceSpectacle;
use nrv\catalogue\domain\service\catalogue\ServiceStyle;
use nrv\catalogue\domain\service\commande\ServiceBillet;
use nrv\catalogue\domain\service\commande\ServicePanier;

class ProviderCommande
{

   public ServiceBillet $serviceBillet;
   public ServicePanier $servicePanier;

    /**
     * @param ServiceBillet $serviceBillet
     */
    public function __construct(ServiceBillet $serviceBillet, ServicePanier $servicePanier)
    {
        $this->serviceBillet = $serviceBillet;
        $this->servicePanier = $servicePanier;
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


}