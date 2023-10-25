<?php

namespace nrv\catalogue\domain\service;


use nrv\catalogue\domain\dto\SpectacleDTO;
use nrv\catalogue\domain\entities\Spectacle;

class ServiceSpectacle
{

    public function getSpectacles():array{
        return Spectacle::all();
    }

    public function getSpectacleById(int $id):SpectacleDTO{
        $spec = Spectacle::find($id);
        return new SpectacleDTO($spec->id,$spec->titre,$spec->description,$spec->style,$spec->urlVideo);
    }

    public function getSpectaclesCatalogue():array{
        $specs = $this->getSpectacles();
        $list = [];
        foreach ($specs as $spec){
            $catalogue = $spec->soirees;
            $list = new SpectacleDTO($catalogue->id,$catalogue->titre,$catalogue->description,$catalogue->style,$catalogue->urlVideo,$catalogue->horaire);
        }
    }





}