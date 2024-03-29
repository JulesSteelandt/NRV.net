<?php

namespace nrv\catalogue\domain\entities\catalogue;

use Illuminate\Database\Eloquent\Model;
use nrv\catalogue\domain\dto\catalogue\SpectacleDTO;

class Spectacle extends Model
{

    public $timestamps = false;
    protected $connection = 'catalogue';
    protected $table = 'SPECTACLE';
    protected $primaryKey = 'id';

    public function artistes()
    {
        return $this->hasMany(Artiste::class, "idSpectacle", "id");
    }

    public function style()
    {
        return $this->belongsTo(Style::class, "idStyle", "id");
    }

    public function soirees()
    {
        return $this->belongsToMany(Soiree::class, "CALENDRIER", "idSpectacle", "idSoiree")->withPivot("horaireSpectacle");
    }

    public function toDTO(): SpectacleDTO
    {
        return new SpectacleDTO(
            $this->id,
            $this->titre,
            $this->description,
            $this->idStyle,
            $this->urlVideo,
            $this->image,
        );
    }
}