<?php

namespace nrv\catalogue\domain\service;


use nrv\catalogue\domain\dto\CatalogueDTO;
use nrv\catalogue\domain\entities\Spectacle;
use Psr\Log\LoggerInterface;
use DateTime;

class ServiceCatalogue
{
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }


    public function getCatalogue():array{
        $specs = Spectacle::all();
        $list = [];
        foreach ($specs as $spec) {
            foreach ($spec->soirees as $heure) {
                $horaire = DateTime::createFromFormat('H:i:s', $heure->pivot->horaireSpectacle);
                $list[] = new CatalogueDTO($heure->id, $spec->id, $horaire);

            }
        }
        $this->logger->info("requête: get table Catalogue");
        return $list;
    }





}