<?php

namespace nrv\catalogue\domain\service;


use DateTime;
use nrv\catalogue\domain\dto\ArtisteDTO;
use nrv\catalogue\domain\dto\CatalogueDTO;
use nrv\catalogue\domain\entities\Artiste;
use nrv\catalogue\domain\entities\Spectacle;
use nrv\catalogue\domain\exception\ArtisteIdException;

class ServiceArtiste
{

    public function getArtisteById(int $id): ArtisteDTO
    {
        $artiste = Artiste::find($id);
        if ($artiste == null) {
            throw new ArtisteIdException($id);
        }
        return $artiste->toDTO();
    }

    public function getArtisteBySpectacle(int $id): array
    {
        $artistes = Artiste::where('idSpectacle',$id)->get();
        $list = [];
        foreach ($artistes as $artiste) {
            $list[] = $artiste->toDTO();
        }
        return $list;
    }

}