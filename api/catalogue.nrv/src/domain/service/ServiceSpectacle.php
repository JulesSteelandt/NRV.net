<?php

namespace nrv\catalogue\domain\service;


use nrv\catalogue\domain\dto\SpectacleDTO;
use nrv\catalogue\domain\entities\Spectacle;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\exception\SpectacleStyleException;
use function PHPUnit\Framework\isEmpty;

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