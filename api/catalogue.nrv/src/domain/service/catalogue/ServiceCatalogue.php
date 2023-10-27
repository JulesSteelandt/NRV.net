<?php

namespace nrv\catalogue\domain\service\catalogue;


use DateTime;
use nrv\catalogue\domain\dto\catalogue\CatalogueDTO;
use nrv\catalogue\domain\entities\catalogue\Spectacle;
use nrv\catalogue\domain\entities\catalogue\Style;

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

    public function getCatalogueSortByStyle(string $style): array
    {
        $styleId = Style::select('id')->where('nom',$style)->first();
        $specs = Spectacle::where('idStyle',$styleId->id)->get();
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