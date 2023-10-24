<?php

namespace nrv\catalogue\domain\entities;

class Lieu extends \Illuminate\Database\Eloquent\Model
{

    protected $connection = 'catalogue';
    protected $table = 'LIEU';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function soirees(){
        return $this->hasMany(Soiree::class,"idLieu","id");
    }



}