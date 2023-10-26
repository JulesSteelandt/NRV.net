<?php

namespace nrv\catalogue\domain\entities;

use nrv\catalogue\domain\dto\LieuDTO;

class Lieu extends \Illuminate\Database\Eloquent\Model
{

    protected $connection = 'catalogue';
    protected $table = 'LIEU';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function soirees(){
        return $this->hasMany(Soiree::class,"idLieu","id");
    }


    public function toDTO():LieuDTO{
        return new LieuDTO(
            $this->id,
            $this->nbPlace,
            $this->nbPlaceAssis,
            $this->nmbPlaceDebout,
            $this->nom,
            $this->adresse
        );
    }


}