<?php

namespace nrv\catalogue\domain\service\catalogue;


use nrv\catalogue\domain\dto\catalogue\LieuDTO;
use nrv\catalogue\domain\entities\catalogue\Lieu;
use nrv\catalogue\domain\exception\LieuIdException;

class ServiceLieu
{

    public function getLieuById(int $id): LieuDTO
    {
        $lieu = Lieu::find($id);
        if ($lieu == null) {
            throw new LieuIdException($id);
        }
        return $lieu->toDTO();
    }

    public function getLieu(): array
    {
        $lieux =  Lieu::all();
        $list = [];
        foreach ($lieux as $lieu) {
            $list[] = $lieu->toDTO();
        }
        return $list;
    }

}