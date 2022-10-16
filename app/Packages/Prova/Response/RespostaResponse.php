<?php

namespace App\Packages\Prova\Response;

use App\Packages\Prova\Models\Questao;

class RespostaResponse
{
    public static function item(Questao $questao): array
    {
        return [
            'id' => $questao->getId(),
            'tema' => $questao->getTema()->getNome(),
            'pergunta' => $questao->getPergunta(),
            'respostas' => array_map(fn($resposta) => [
                'id' => $resposta->getId(),
                'resposta' => $resposta->getAlternativa(),
                'correta' => $resposta->isCorreta(),
            ], $questao->getAlternativas()->toArray())
        ];
    }

    public static function collection($questoes): array
    {
        return array_map(fn($questao) => self::item($questao), $questoes);
    }
}