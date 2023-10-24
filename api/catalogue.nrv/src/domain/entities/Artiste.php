<?php

namespace nrv\catalogue\domain\entities;

class Artiste extends \Illuminate\Database\Eloquent\Model
{

    protected $connection = 'catalogue';
    protected $table = 'ARTISTE';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function spectacle(){
        return $this->belongsTo(Spectacle::class,'idSpectacle','id');
    }
}