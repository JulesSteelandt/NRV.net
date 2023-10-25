<?php

namespace nrv\catalogue\domain\entities;

use Illuminate\Database\Eloquent\Model;
use nrv\catalogue\domain\dto\SoireeDTO;

class Style extends Model
{

    public $timestamps = false;
    protected $connection = 'catalogue';
    protected $table = 'STYLE';
    protected $primaryKey = 'id';

    public function spectacle()
    {
        return $this->hasMany(Style::class, "idStyle", "id");
    }
}