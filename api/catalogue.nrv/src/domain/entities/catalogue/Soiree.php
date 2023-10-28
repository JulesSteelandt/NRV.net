<?php

namespace nrv\catalogue\domain\entities\catalogue;

use nrv\catalogue\domain\dto\catalogue\SoireeDTO;
use DateTime;
use nrv\catalogue\domain\entities\commande\Commande;
use nrv\catalogue\domain\entities\commande\Panier;

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

    public function commande(){
        return $this->belongsToMany(Commande::class,"COMMANDE2SOIREE","idCommande","idSoiree")
            ->withPivot("typeTarif",'nmbPlace');
    }


    public function toDTO(int $nbPlace = 0, int $typeTarif = 0):SoireeDTO{
        return new SoireeDTO(
            $this->id,
            $this->idLieu,
            $this->nom,
            $this->theme,
            $this->tarifNormal,
            $this->tarifReduit,
            DateTime::createFromFormat('Y-m-d', $this->date),
            DateTime::createFromFormat('H:i:s', $this->horaireDebut),
            $this->nbPlaceRestante,
            $nbPlace,
            $typeTarif
        );
    }




}