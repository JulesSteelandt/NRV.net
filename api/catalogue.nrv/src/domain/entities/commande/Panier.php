<?php

namespace nrv\catalogue\domain\entities\commande;

use Illuminate\Database\Eloquent\Model;
use nrv\catalogue\domain\dto\commande\PanierDTO;
use nrv\catalogue\domain\entities\catalogue\Soiree;

class Panier extends Model {

    protected $connection = 'catalogue';

    protected $table = 'PANIER';

    protected $primaryKey =['mailUser', 'idSoiree'];
    protected $keyType = 'string';
    public $timestamps = false;

    public function soiree(){
        return $this->belongsTo(Soiree::class, "idSoiree", "id");
    }


    public function toDTO():PanierDTO{
        return new PanierDTO(
            $this->mailUser,
            $this->idSoiree,
            $this->nmbplace,
            $this->typeTarif
        );
    }



}