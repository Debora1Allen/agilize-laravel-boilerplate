<?php

namespace App\Packages\Prova\Response;

class TemaResponse
{
    public static function item($tema): array
    {
        return [
            'id' => $tema->getId(),
            'name' => $tema->getNome(),
        ];
    }

    public static function collection($temas): array
    {
        return array_map(fn($tema) => self::item($tema), $temas);
    }
}