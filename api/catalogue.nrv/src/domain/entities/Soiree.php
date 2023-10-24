<?php

namespace nrv\catalogue\domain\entities;

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




}