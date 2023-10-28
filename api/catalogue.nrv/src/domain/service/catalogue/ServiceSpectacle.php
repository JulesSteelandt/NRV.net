<?php

namespace nrv\catalogue\domain\service\catalogue;


use nrv\catalogue\domain\dto\catalogue\SpectacleDTO;
use nrv\catalogue\domain\entities\catalogue\Spectacle;
use nrv\catalogue\domain\exception\SpectacleIdException;

class ServiceSpectacle
{

    public function getSpectacles(): array
    {
        $specs = Spectacle::all();
        $list = [];
        foreach ($specs as $spec) {
            $list[] = $spec->toDTO();
        }

        return $list;
    }

    public function getSpectacleById(int $id): SpectacleDTO
    {
        $spec = Spectacle::find($id);
        if ($spec == null) {
            throw new SpectacleIdException($id);
        }
        return $spec->toDTO();
    }
}