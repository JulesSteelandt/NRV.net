<?php

namespace nrv\catalogue\app\provider;

use nrv\catalogue\domain\dto\catalogue\StyleDTO;
use nrv\catalogue\domain\dto\catalogue\ArtisteDTO;
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

class ProviderCatalogue
{

    private ServiceCatalogue $serviceCatalogue;
    private ServiceSpectacle $serviceSpectacle;
    private ServiceSoiree $serviceSoiree;
    private ServiceArtiste $serviceArtiste;
    private ServiceStyle $serviceStyle;
    private ServiceLieu $serviceLieu;

    /**
     * @param ServiceCatalogue $serviceCatalogue
     * @param ServiceSpectacle $serviceSpectacle
     * @param ServiceSoiree $serviceSoiree
     * @param ServiceArtiste $serviceArtiste
     * @param ServiceStyle $serviceStyle
     * @param ServiceLieu $serviceLieu
     */
    public function __construct(ServiceCatalogue $serviceCatalogue, ServiceSpectacle $serviceSpectacle, ServiceSoiree $serviceSoiree, ServiceArtiste $serviceArtiste, ServiceStyle $serviceStyle, ServiceLieu $serviceLieu)
    {
        $this->serviceCatalogue = $serviceCatalogue;
        $this->serviceSpectacle = $serviceSpectacle;
        $this->serviceSoiree = $serviceSoiree;
        $this->serviceArtiste = $serviceArtiste;
        $this->serviceStyle = $serviceStyle;
        $this->serviceLieu = $serviceLieu;
    }


    /**
     * @throws SpectacleIdException
     * @throws SoireeIdException
     * @throws StyleIdException
     * @throws LieuIdException
     */
    public function getProgramme(string $tri = 'null', string $data = ''): array
    {
        $cat = null;
        if ($tri == "style") {
            $cat = $this->serviceCatalogue->getCatalogueSortByStyle($data);
        }
        if ($tri == "date") {
            $cat = $this->serviceCatalogue->getCatalogueSortByStyle($data);
        }
        if ($tri == "lieu") {
            $cat = $this->serviceCatalogue->getCatalogueByLieu($data);
        }
        if ($tri == 'null') {
            $cat = $this->serviceCatalogue->getCatalogue();
        }

        $list = [];
        $i = 0;

        foreach ($cat as $spec) {
            $i++;
            $specDTO = $this->serviceSpectacle->getSpectacleById($spec->idSpectacle);
            $soireeDTO = $this->serviceSoiree->getSoireesById($spec->idSoiree);
            $list[$i] = ['spectacle' => $specDTO, 'soiree' => $soireeDTO, 'horaire' => $spec->horaireSpectacle, 'image' => $specDTO->image];
        }

        return $list;
    }

    /**
     * @throws SpectacleIdException
     * @throws StyleIdException
     */
    public function getSpectacleById(int $id): array
    {
        $spec = $this->serviceSpectacle->getSpectacleById($id);
        $art = $this->serviceArtiste->getArtisteBySpectacle($id);
        $style = $this->serviceStyle->getStyleById($spec->style);
        return ['spectacle' => $spec, 'artistes' => $art, 'style' => $style->nom];
    }

    /**
     * @throws StyleIdException
     */
    public function getStyleById(int $id): StyleDTO
    {
        return $this->serviceStyle->getStyleById($id);
    }

    /**
     * @throws ArtisteIdException
     */
    public function getArtisteById(int $id): ArtisteDTO
    {
        return $this->serviceArtiste->getArtisteById($id);
    }

    /**
     * @throws SoireeIdException
     * @throws SpectacleIdException
     * @throws LieuIdException
     */
    public function getSoireeById(int $id): array
    {
        $soiree = $this->serviceSoiree->getSoireesById($id);
        $specs = $this->serviceSoiree->getSpectacleBySoiree($id);
        $spectacles = [];
        foreach ($specs as $spec) {
            $spectacles[] = $this->getSpectacleById($spec);
        }
        $lieu = $this->serviceLieu->getLieuById($soiree->idLieu);
        return ['soiree' => $soiree, 'spectacles' => $spectacles, 'lieu' => $lieu];
    }

    public function getStyle(): array
    {
        return $this->serviceStyle->getStyle();
    }


}