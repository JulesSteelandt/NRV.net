<?php

namespace nrv\catalogue\domain\dto;


use DateTime;

class SpectacleDTO extends DTO
{

    public int $id, $style;
    public string $titre, $description;
    public ?string $urlVideo;

    /**
     * @param int $id
     * @param string $titre
     * @param string $description
     * @param int $style
     * @param string|null $urlVideo
     */
    public function __construct(int $id, string $titre, string $description, int $style, ?string $urlVideo = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->style = $style;
        $this->urlVideo = $urlVideo;
    }

}