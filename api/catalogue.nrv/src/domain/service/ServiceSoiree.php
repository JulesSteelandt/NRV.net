<?php

namespace nrv\catalogue\domain\service;



use nrv\catalogue\domain\dto\SoireeDTO;
use nrv\catalogue\domain\entities\Soiree;

class ServiceSoiree
{

    public function getSoirees():array{
        $soirees = Soiree::all();
        $list = [];
        foreach ($soirees as $soiree){
            $list = $soiree->toDTO();
        }
        return $list;
    }

    public function getSoireesById(int $id):SoireeDTO{
        $spec = Soiree::find($id);
        return $spec->toDTO();
    }
}