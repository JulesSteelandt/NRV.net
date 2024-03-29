<?php

namespace nrv\catalogue\domain\dto\catalogue;

use nrv\catalogue\domain\dto\DTO;

use DateTime;

class SpectacleDTO extends DTO
{

    public int $id, $style;
    public string $titre, $description;
    public ?string $urlVideo,$image;

    /**
     * @param int $id
     * @param string $titre
     * @param string $description
     * @param int $style
     * @param string|null $urlVideo
     */
    public function __construct(int $id, string $titre, string $description, int $style, ?string $urlVideo = null,?string $image = null)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
        $this->style = $style;
        $this->urlVideo = $urlVideo;
        $this->image = $image;
    }

}