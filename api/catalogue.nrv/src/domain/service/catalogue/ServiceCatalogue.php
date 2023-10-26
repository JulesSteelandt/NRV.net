<?php

namespace nrv\catalogue\domain\service\catalogue;


use DateTime;
use nrv\catalogue\domain\dto\catalogue\CatalogueDTO;
use nrv\catalogue\domain\entities\catalogue\Spectacle;

class ServiceCatalogue
{

    public function getCatalogue(): array
    {
        $specs = Spectacle::all();
        $list = [];
        foreach ($specs as $spec) {
            foreach ($spec->soirees as $heure) {
                $horaire = DateTime::createFromFormat('H:i:s', $heure->pivot->horaireSpectacle);
                $list[] = new CatalogueDTO($heure->id, $spec->id, $horaire);

            }
        }
        return $list;
    }


}