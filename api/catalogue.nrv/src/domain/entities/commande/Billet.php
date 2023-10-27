<?php

namespace nrv\catalogue\domain\entities\commande;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use nrv\catalogue\domain\dto\commande\BilletDTO;
use nrv\catalogue\domain\entities\catalogue\Soiree;

class Billet extends Model {


    protected $connection = 'catalogue';

    protected $table = 'BILLET';

    protected $primaryKey = 'reference';
    protected $keyType = 'string';
    public $timestamps = false;

    public function soiree(){
        return $this->belongsTo(Soiree::class, "idSoiree", "id");
    }

    public function toDTO():BilletDTO{
        return new BilletDTO(
            $this->reference,
            $this->idSoiree,
            $this->mailUser,
            DateTime::createFromFormat('Y-m-d', $this->date),
            DateTime::createFromFormat('H:i:s', $this->horaire),
            $this->catTarif
        );
    }



}