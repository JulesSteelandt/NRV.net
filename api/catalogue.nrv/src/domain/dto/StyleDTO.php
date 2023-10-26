<?php

namespace nrv\catalogue\domain\dto;


use DateTime;

class StyleDTO extends DTO
{

    public int $id;
    public string $nom;

    /**
     * @param int $id
     * @param string $nom
     */
    public function __construct(int $id, string $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }


}