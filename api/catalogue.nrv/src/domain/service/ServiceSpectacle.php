<?php

namespace nrv\catalogue\domain\service;


use nrv\catalogue\domain\dto\SpectacleDTO;
use nrv\catalogue\domain\entities\Spectacle;
use nrv\catalogue\domain\exception\SpectacleIdException;
use nrv\catalogue\domain\exception\SpectacleStyleException;
use Psr\Log\LoggerInterface;
use function PHPUnit\Framework\isEmpty;

class ServiceSpectacle
{

    private LoggerInterface $logger;


    public function __construct(LoggerInterface $log)
    {
        $this->logger = $log;
    }


    public function getSpectacles(): array
    {
        $specs = Spectacle::all();
        $list = [];
        foreach ($specs as $spec) {
            $list[] = $spec->toDTO();
        }
        $this->logger->info("requête: get de l'Ensemble de la table Spectacle");
        return $list;
    }

    public function getSpectacleById(int $id): SpectacleDTO
    {
        $spec = Spectacle::find($id);
        if ($spec == null) {
            $this->logger->error("requête: Spectacle $id n'existe pas");
            throw new SpectacleIdException($id);
        }
        $this->logger->info("requête: get Spectacle $id");
        return $spec->toDTO();
    }

    public function getSpectacleByStyle(string $style)
    {
        $specs = Spectacle::where('style', $style)->get();
        if ($specs - isEmpty()) {
            $this->logger->error("requête: aucun Spectacle de $style n'existe");
            throw new SpectacleStyleException($style);
        }
        $list = [];
        foreach ($specs as $spec) {
            $list = $spec->toDTO();
        }
        $this->logger->info("requête: get des spectacles de $style");
        return $list;
    }


}