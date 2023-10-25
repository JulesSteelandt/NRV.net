<?php

namespace nrv\catalogue\domain\service;


use nrv\catalogue\domain\dto\SpectacleDTO;
use nrv\catalogue\domain\entities\Spectacle;
use nrv\catalogue\domain\exception\SpectacleIdException;

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
        $spec = Spectacle::find($id);
        if ($spec==null){
            throw new SpectacleIdException($id);
        }
        return $spec->toDTO();
    }

    public function getSpectaclesCatalogue():array{
        $specs = $this->getSpectacles();
        $list = [];
        foreach ($specs as $spec){
            $catalogue = $spec->soirees;
            $soiree = $this->serviceSoiree->getSoireesById($catalogue->idSoiree);
            $spec = $spec->toDTO;
            $spec->horaire = $catalogue->horaireSpectacle;
            $spec->date = $soiree->date;
            $list = $spec;
        }
        return $list;
    }





}