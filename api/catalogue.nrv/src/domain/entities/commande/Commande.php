<?php

namespace nrv\catalogue\domain\entities\commande;

use Illuminate\Database\Eloquent\Model;
use nrv\catalogue\domain\dto\commande\CommandeDTO;
use nrv\catalogue\domain\entities\catalogue\Soiree;

class Commande extends Model    {

    protected $connection = 'commande';

    protected $table = 'COMMANDE';

    protected $primaryKey = 'idCommande';
    protected $keyType = 'string';
    public $timestamps = false;

    public function soiree(){
        return $this->belongsToMany(Soiree::class,"COMMANDE2SOIREE","idCommande","idSoiree")
            ->withPivot("typeTarif",'nmbPlace');
    }

    public function toDTO():CommandeDTO{
        return new CommandeDTO(
            $this->idCommande,
            $this->mailUser,
            $this->statut,
            $this->total
        );
    }

}