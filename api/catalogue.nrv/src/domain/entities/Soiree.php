<?php

namespace nrv\catalogue\domain\entities;

use nrv\catalogue\domain\dto\SoireeDTO;

class Soiree extends \Illuminate\Database\Eloquent\Model
{

    protected $connection = 'catalogue';
    protected $table = 'SOIREE';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function lieu(){
        return $this->belongsTo(Lieu::class, "idLieu","id");
    }

    public function spectacles(){
        return $this->belongsToMany(Spectacle::class,"CALENDRIER","idSoiree","idSpectacle")->withPivot("horaireSpectacle");
    }

    public function toDTO():SoireeDTO{
        return new SoireeDTO(
            $this->id,
            $this->idLieu,
            $this->nom,
            $this->theme,
            $this->tarifNormal,
            $this->tarifReduit,
            $this->date->format('Y-m-d'),
            $this->horaireDebut->format('H-i-s')
        );
    }




}