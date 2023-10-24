<?php

namespace nrv\auth\domain\entities;

use Illuminate\Database\Eloquent\Model;

class Utilisateur extends Model {

    protected $connection = 'auth';

    protected $table = 'UTILISATEUR';

    protected $primaryKey = 'email';
    protected $keyType = 'string';
    public $timestamps = false;

    public function toDTO(): UserDTO {
        return new UserDTO(
            $this->email,
            $this->nom,
            $this->prenom,
            $this->typeUtil
        );
    }


}