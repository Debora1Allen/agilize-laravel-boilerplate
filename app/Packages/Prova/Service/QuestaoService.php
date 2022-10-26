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
     * @param string $slugname
     * @param string $texto
     * @return Questao
     */
    public function create(string $slugname, string $texto): Questao
    {
        $tema = $this->temaRepository->findOneBySlugname($slugname);
        $questao = new Questao($tema, $texto);
        return $questao;
    }

    /**
     * @param Questao $questao
     * @param array $respostas
     * @return void
     */
    public function addRespostas(Questao $questao, array $respostas): void
    {
        $questao->setRespostas($respostas);
    }
}