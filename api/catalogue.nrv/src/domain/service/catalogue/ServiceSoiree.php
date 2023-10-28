<?php

namespace nrv\catalogue\domain\service\catalogue;


use nrv\catalogue\domain\dto\catalogue\SoireeDTO;
use nrv\catalogue\domain\entities\catalogue\Soiree;
use nrv\catalogue\domain\exception\SoireeIdException;

class ServiceSoiree
{

    public function getSoirees(): array
    {
        $soirees = Soiree::all();
        $list = [];
        foreach ($soirees as $soiree) {
            $list[] = $soiree->toDTO();
        }
        return $list;
    }

    public function getSoireesById(int $id): SoireeDTO
    {
        $soiree = Soiree::find($id);
        if ($soiree == null) {
            throw new SoireeIdException($id);
        }
        return $soiree->toDTO();
    }

    public function getSpectacleBySoiree(int $id): array{
        $soiree = Soiree::find($id);
        if ($soiree == null) {
            throw new SoireeIdException($id);
        }
        $list = [];
        foreach ($soiree->spectacles as $soiree){
            $list[] = $soiree->id;
        }
        return $list;
    }

    public function getPlaceVendu(): array{
        $soirees = Soiree::all();
        $list = [];
        foreach ($soirees as $soiree){
            $list[$soiree->id]['soiree'] = $soiree;
            $list[$soiree->id]['nbPlaceTotal'] = $soiree->lieu->nbPlace;
            $list[$soiree->id]['nbPlaceRestante'] = $soiree->nbPlaceRestante;
            $list[$soiree->id]['nbPlaceVendu'] = $soiree->lieu->nbPlace - $soiree->nbPlaceRestante;
        }
        return $list;
    }
}