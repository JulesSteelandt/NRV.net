<?php

namespace nrv\catalogue\domain\entities\catalogue;

use nrv\catalogue\domain\dto\ArtisteDTO;

class Artiste extends \Illuminate\Database\Eloquent\Model
{

    protected $connection = 'catalogue';
    protected $table = 'ARTISTE';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function spectacle(){
        return $this->belongsTo(Spectacle::class,'idSpectacle','id');
    }

    public function toDTO(){
        return new ArtisteDTO(
            $this->id,
            $this->nom,
            $this->prenom,
            $this->pseudo,
            $this->idSpectacle
        );
    }
}