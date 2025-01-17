<?php

namespace App\Packages\Prova\Response;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Models\Templates\QuestaoProva;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\RespostaProva;
use Doctrine\Common\Collections\Collection;

class ProvaResponse
{
    public static function item(Prova $prova): array
    {
        /**@var QuestaoProva $questao  */
        return [
            'id' => $prova->getId(),
            'questoes' => array_map(function ($questao) use ($prova) {
                $questaoData = [
                    'id' => $questao->getId(),
                    'texto' => $questao->getTexto(),
                    'respostaAluno' => $questao->getRespostaAluno(),

                ];
                if ($prova->getStatus() === Prova::ABERTA) {
                    $questaoData['texto'] = array_map(function ($respostasAluno) {
                        return [
                            'id' => $respostasAluno->getId(),
                            'texto' => $respostasAluno->getTexto(),
                        ];
                    }, $questao->getRespostas()->toArray());
                }
                if ($prova->getStatus() === Prova::CONCLUIDA) {
                    $questaoData['respostaCorreta'] = $questao->getRespostaCorreta();
                }
                return $questaoData;
            }, $prova->getQuestoes()->toArray()),
            'status' => $prova->getStatus(),
            'nota' => $prova->getNota(),
            'notaMaxima' => Prova::NOTA_MAXIMA
        ];
    }
    public static function collection(array $provas): array
    {
        return array_map(fn($prova) => self::item($prova), $provas);
    }
}