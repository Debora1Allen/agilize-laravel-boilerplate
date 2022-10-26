<?php

namespace App\Packages\Prova\Service;

use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Repository\TemaRepository;

class QuestaoService
{
    public function __construct(private TemaRepository $temaRepository)
    {
    }

    public function create(string $temaSlugname, string $pergunta): Questao
    {
        $tema = $this->temaRepository->findOneBySlugname($temaSlugname);
        $questao = new Questao($tema, $pergunta);
        return $questao;
    }

    public function addRespostas(Questao $questao, array $alternativas): void
    {
        $questao->setRespostas($alternativas);
    }

}