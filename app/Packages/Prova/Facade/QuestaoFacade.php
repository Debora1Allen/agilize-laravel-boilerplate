<?php

namespace App\Packages\Prova\Facade;

use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Service\QuestaoService;

class QuestaoFacade
{
    public function __construct(private QuestaoService $questaoService, private QuestaoRepository $questaoRepository)
    {
    }

    public function create(string $temaSlugname, string $pergunta): Questao
    {
        $questao = $this->questaoService->create($temaSlugname, $pergunta);
        $this->questaoRepository->add($questao);
        return $questao;
    }

    public function addAlternativas(Questao $questao, array $alternativas): Questao
    {
        $this->questaoService->addAlternativas($questao, $alternativas);
        $this->questaoRepository->update($questao);
        return $questao;
    }

    public function getAll()
    {
        return $this->questaoRepository->findAll();
    }
}