<?php

namespace nrv\catalogue\domain\entities;

class Spectacle extends \Illuminate\Database\Eloquent\Model
{

    protected $connection = 'catalogue';
    protected $table = 'SPECTACLE';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function artistes(){
        return $this->hasMany(Artiste::class, "idSpectacle","id");
    }

    public function soirees(){
        return $this->belongsToMany(Soiree::class,"CALENDRIER","idSpectacle","idSoiree")->withPivot("horaireSpectacle");
    }
}