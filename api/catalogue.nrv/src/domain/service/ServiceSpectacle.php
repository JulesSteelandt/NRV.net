<?php

namespace nrv\catalogue\domain\service;


use nrv\catalogue\domain\dto\SpectacleDTO;
use nrv\catalogue\domain\entities\Spectacle;

class ServiceSpectacle
{

    private ServiceSoiree $serviceSoiree;

    /**
     * @param ServiceSoiree $serviceSoiree
     */
    public function __construct(ServiceSoiree $serviceSoiree)
    {
        $this->serviceSoiree = $serviceSoiree;
    }


    public function getSpectacles():array{
        $specs = Spectacle::all();
        $list = [];
        foreach ($specs as $spec){
            $list = $spec->toDTO();
        }
        return $list;
    }

    public function getSpectacleById(int $id):SpectacleDTO{
        return Spectacle::find($id)->toDTO();
    }

    public function getSpectaclesCatalogue():array{
        $specs = $this->getSpectacles();
        $list = [];
        foreach ($specs as $spec){
            $catalogue = $spec->soirees;
            $spec = $spec->toDTO;
            $spec->horaire = $catalogue->horaireSpectacle;
            $list = $spec;
        }
        return $list;
    }





}