<?php

namespace nrv\catalogue\domain\entities\commande;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model    {

    protected $connection = 'commande';

    protected $table = 'COMMANDE';

    protected $primaryKey = 'idCommande';
    protected $keyType = 'string';
    public $timestamps = false;

}