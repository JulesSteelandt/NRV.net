<?php

namespace nrv\catalogue\domain\entities\commande;

use Illuminate\Database\Eloquent\Model;

class Billet extends Model {


    protected $connection = 'commande';

    protected $table = 'BILLET';

    protected $primaryKey = 'reference';
    protected $keyType = 'string';
    public $timestamps = false;



}