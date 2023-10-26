<?php

namespace nrv\catalogue\domain\service\catalogue;


use nrv\catalogue\domain\dto\StyleDTO;
use nrv\catalogue\domain\entities\Style;
use nrv\catalogue\domain\exception\StyleIdException;

class ServiceStyle
{

    public function getStyleById(int $id): StyleDTO
    {
        $style = Style::find($id);
        if ($style == null) {
            throw new StyleIdException($id);
        }
        return $style->toDTO();
    }

    public function getStyle(): array
    {
        $styles =  Style::all();
        $list = [];
        foreach ($styles as $style) {
            $list[] = $style->toDTO();
        }
        return $list;
    }

}