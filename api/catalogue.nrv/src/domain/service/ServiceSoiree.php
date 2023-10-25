<?php

namespace nrv\catalogue\domain\service;



use nrv\catalogue\domain\dto\SoireeDTO;
use nrv\catalogue\domain\entities\Soiree;
use nrv\catalogue\domain\exception\SoireeIdException;
use Psr\Log\LoggerInterface;

class ServiceSoiree
{

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $log)
    {
        $this->logger = $log;
    }

    public function getSoirees():array{
        $soirees = Soiree::all();
        $list = [];
        foreach ($soirees as $soiree){
            $list = $soiree->toDTO();
        }
        $this->logger->info("requête: get de l'Ensemble de la table Soiree");
        return $list;
    }

    public function getSoireesById(int $id):SoireeDTO{
        $spec = Soiree::find($id);
        if ($spec==null){
            $this->logger->error("requête: Soiree $id n'existe pas");
            throw new SoireeIdException($id);
        }
        $this->logger->info("requête: get Soiree $id");
        return $spec->toDTO();
    }
}