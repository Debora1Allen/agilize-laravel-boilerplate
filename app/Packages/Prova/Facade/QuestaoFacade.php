<?php

namespace App\Packages\Prova\Facade;

use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Service\QuestaoService;

/**
 *
 */
class QuestaoFacade
{
    /**
     * @var QuestaoService
     */
    protected QuestaoService $questaoService;
    /**
     * @var QuestaoRepository
     */
    protected QuestaoRepository $questaoRepository;

    /**
     * @param QuestaoService $questaoService
     * @param QuestaoRepository $questaoRepository
     */
    public function __construct(QuestaoService $questaoService, QuestaoRepository $questaoRepository)
    {
        $this->questaoService = $questaoService;
        $this->questaoRepository = $questaoRepository;
    }

    /**
     * @param string $temaSlugname
     * @param string $pergunta
     * @return Questao
     */
    public function create(string $temaSlugname, string $pergunta): Questao
    {
        $questao = $this->questaoService->create($temaSlugname, $pergunta);
        $this->questaoRepository->add($questao);
        return $questao;
    }

    /**
     * @param Questao $questao
     * @param array $respostas
     * @return Questao
     */
    public function addRespostas(Questao $questao, array $respostas): Questao
    {
        $this->questaoService->addRespostas($questao, $respostas);
        $this->questaoRepository->update($questao);
        return $questao;
    }

    /**
     * @return array|object[]
     */
    public function getAll()
    {
        return $this->questaoRepository->findAll();
    }
}