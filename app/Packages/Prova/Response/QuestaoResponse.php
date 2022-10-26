<?php

namespace App\Packages\Prova\Response;

use App\Packages\Prova\Models\Questao;

class QuestaoResponse
{
    public static function item(Questao $questao): array
    {
        return [
            'id' => $questao->getId(),
            'tema' => $questao->getTema()->getNome(),
            'resposta' => $questao->getRepostas(),
            'respostas' => array_map(fn($resposta) => [
                'id' => $resposta->getId(),
                'resposta' => $resposta->getAlternativa(),
                'correta' => $resposta->isCorreta(),
            ], $questao->getRepostas()->toArray())
        ];
    }

    public static function collection($questoes): array
    {
        return array_map(fn($questao) => self::item($questao), $questoes);
    }
}