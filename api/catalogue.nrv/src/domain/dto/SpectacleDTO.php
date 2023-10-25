<?php

namespace nrv\catalogue\domain\dto;


use DateTime;

class SpectacleDTO extends DTO
{

    public int $id;
    public string $titre, $description, $style;
    public ?string $urlVideo;
    public ?DateTime $date, $horaire;

    /**
     * @param int $id
     * @param string $titre
     * @param string $description
     * @param string $style
     * @param string|null $urlVideo
     * @param DateTime|null $date
     * @param DateTime|null $horaire
     */
    public function __construct(int $id, string $titre, string $description, string $style, ?string $urlVideo = null, ?DateTime $date = null, ?DateTime $horaire = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->style = $style;
        $this->urlVideo = $urlVideo;
        $this->date = $date;
        $this->horaire = $horaire;
    }

}