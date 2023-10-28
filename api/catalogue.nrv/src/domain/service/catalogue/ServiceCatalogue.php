<?php

namespace nrv\catalogue\domain\service\catalogue;


use DateTime;
use nrv\catalogue\domain\dto\catalogue\CatalogueDTO;
use nrv\catalogue\domain\entities\catalogue\Lieu;
use nrv\catalogue\domain\entities\catalogue\Spectacle;
use nrv\catalogue\domain\entities\catalogue\Style;
use nrv\catalogue\domain\exception\LieuIdException;
use nrv\catalogue\domain\exception\StyleIdException;

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
        $styleId = Style::select('id')->where('nom', $style)->first();
        if ($styleId != null) {
            $specs = Spectacle::where('idStyle', $styleId->id)->get();
        } else {
            throw new StyleIdException($style);
        }
        $list = [];
        foreach ($specs as $spec) {
            foreach ($spec->soirees as $heure) {
                $horaire = DateTime::createFromFormat('H:i:s', $heure->pivot->horaireSpectacle);
                $list[] = new CatalogueDTO($heure->id, $spec->id, $horaire);
            }
        }
        return $list;
    }

    public function getCatalogueByLieu(int $id): array
    {
        $lieu = Lieu::find($id);
        if ($lieu == null) {
            throw new LieuIdException($id);
        }
        $soirees = $lieu->soirees;
        $list = [];

        foreach ($soirees as $soiree) {
                foreach ($soiree->spectacles as $heure) {
                    $horaire = DateTime::createFromFormat('H:i:s', $heure->pivot->horaireSpectacle);
                    $list[] = new CatalogueDTO($soiree->id, $heure->id, $horaire);

            }
        }

        return $list;
    }


}