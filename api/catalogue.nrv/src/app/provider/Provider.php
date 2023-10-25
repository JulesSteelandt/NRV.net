<?php

namespace nrv\catalogue\app\provider;

use nrv\catalogue\domain\exception\SoireeIdException;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\service\ServiceCatalogue;
use nrv\catalogue\domain\service\ServiceSoiree;
use nrv\catalogue\domain\service\ServiceSpectacle;

class Provider
{

    private ServiceCatalogue $serviceCatalogue;
    private ServiceSpectacle $serviceSpectacle;
    private ServiceSoiree $serviceSoiree;

    /**
     * @param ServiceCatalogue $serviceCatalogue
     * @param ServiceSpectacle $serviceSpectacle
     * @param ServiceSoiree $serviceSoiree
     */
    public function __construct(ServiceCatalogue $serviceCatalogue, ServiceSpectacle $serviceSpectacle, ServiceSoiree $serviceSoiree)
    {
        $this->serviceCatalogue = $serviceCatalogue;
        $this->serviceSpectacle = $serviceSpectacle;
        $this->serviceSoiree = $serviceSoiree;
    }

    /**
     * @throws SpectacleIdException
     * @throws SoireeIdException
     */
    public function getProgramme()
    {
        $cat = $this->serviceCatalogue->getCatalogue();

        $list = [];
        $i = 0;

        foreach ($cat as $spec) {
            $i++;
            $specDTO = $this->serviceSpectacle->getSpectacleById($spec->idSpectacle);
            $soireeDTO = $this->serviceSoiree->getSoireesById($spec->idSoiree);
            $list[$i] = ['spectacle' => $specDTO, 'soiree' => $soireeDTO, 'horaire'=>$spec->horaireSpectacle];
        }

        return $list;


    }


}