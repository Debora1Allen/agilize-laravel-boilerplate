<?php

namespace App\Packages\Prova\Service;

use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Repository\TemaRepository;

/**
 *
 */
class QuestaoService
{
    /**
     * @var TemaRepository
     */
    protected TemaRepository $temaRepository;

    /**
     * @param TemaRepository $temaRepository
     */
    public function __construct(TemaRepository $temaRepository)
    {
        $this->temaRepository = $temaRepository;
    }

    /**
     * @param string $temaSlugname
     * @param string $pergunta
     * @return Questao
     */
    public function create(string $temaSlugname, string $pergunta): Questao
    {
        $tema = $this->temaRepository->findOneBySlugname($temaSlugname);
        $questao = new Questao($tema, $pergunta);
        return $questao;
    }

    /**
     * @param Questao $questao
     * @param array $alternativas
     * @return void
     */
    public function addRespostas(Questao $questao, array $alternativas): void
    {
        $questao->setRespostas($alternativas);
    }

}