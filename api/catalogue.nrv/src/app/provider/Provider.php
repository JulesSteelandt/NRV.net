<?php

namespace nrv\catalogue\app\provider;

use nrv\catalogue\domain\dto\ArtisteDTO;
use nrv\catalogue\domain\dto\StyleDTO;
use nrv\catalogue\domain\exception\ArtisteIdException;
use nrv\catalogue\domain\exception\SoireeIdException;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\exception\StyleIdException;
use nrv\catalogue\domain\service\ServiceArtiste;
use nrv\catalogue\domain\service\ServiceCatalogue;
use nrv\catalogue\domain\service\ServiceSoiree;
use nrv\catalogue\domain\service\ServiceSpectacle;
use nrv\catalogue\domain\service\ServiceStyle;

class Provider
{

    private ServiceCatalogue $serviceCatalogue;
    private ServiceSpectacle $serviceSpectacle;
    private ServiceSoiree $serviceSoiree;
    private ServiceArtiste $serviceArtiste;
    private ServiceStyle $serviceStyle;
    /**
     * @param ServiceCatalogue $serviceCatalogue
     * @param ServiceSpectacle $serviceSpectacle
     * @param ServiceSoiree $serviceSoiree
     */
    public function __construct(ServiceCatalogue $serviceCatalogue, ServiceSpectacle $serviceSpectacle, ServiceSoiree $serviceSoiree, ServiceArtiste $serviceArtiste, ServiceStyle $serviceStyle)
    {
        $this->serviceCatalogue = $serviceCatalogue;
        $this->serviceSpectacle = $serviceSpectacle;
        $this->serviceSoiree = $serviceSoiree;
        $this->serviceArtiste = $serviceArtiste;
        $this->serviceStyle = $serviceStyle;
    }

    /**
     * @throws SpectacleIdException
     * @throws SoireeIdException
     */
    public function getProgramme() : array
    {
        $cat = $this->serviceCatalogue->getCatalogue();

        $list = [];
        $i = 0;

        foreach ($cat as $spec) {
            $i++;
            $specDTO = $this->serviceSpectacle->getSpectacleById($spec->idSpectacle);
            $soireeDTO = $this->serviceSoiree->getSoireesById($spec->idSoiree);
            $list[$i] = ['spectacle' => $specDTO, 'soiree' => $soireeDTO, 'horaire' => $spec->horaireSpectacle];
        }

        return $list;
    }

    /**
     * @throws SpectacleIdException
     */
    public function getSpectacleById(int $id): array
    {
        $spec = $this->serviceSpectacle->getSpectacleById($id);
        $art = $this->serviceArtiste->getArtisteBySpectacle($id);
        return ['spectacle'=>$spec,'artistes'=>$art];
    }

    /**
     * @throws ArtisteIdException
     */
    public function getArtisteById(int $id) : ArtisteDTO{
        return $this->serviceArtiste->getArtisteById($id);
    }

    /**
     * @throws SoireeIdException
     */
    public function getSoireeById(int $id) : array{
        $soiree = $this->serviceSoiree->getSoireesById($id);
        $spec = $this->serviceSoiree->getSpectacleBySoiree($id);
        return ['soiree'=>$soiree,'spectacles'=>$spec];
    }

    public function getStyle():array{
        return $this->serviceStyle->getStyle();
    }

    /**
     * @throws StyleIdException
     */
    public function getStyleById(int $id):StyleDTO{
        return $this->serviceStyle->getStyleById($id);
    }


}