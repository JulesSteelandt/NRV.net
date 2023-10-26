<?php

namespace nrv\catalogue\domain\entities\commande;

use Illuminate\Database\Eloquent\Model;

class Panier extends Model {

    protected $connection = 'commande';

    protected $table = 'PANIER';

    protected $primaryKey =['mailUser', 'idSoiree'];
    protected $keyType = 'string';
    public $timestamps = false;



}