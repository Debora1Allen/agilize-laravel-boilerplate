<?php

namespace App\Packages\Prova\Facade;

use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\Service\TemaService;

/**
 *
 */
class TemaFacade
{
    /**
     * @var TemaRepository
     */
    protected TemaRepository $temaRepository;
    /**
     * @var TemaService
     */
    protected TemaService $temaService;

    /**
     * @param TemaRepository $temaRepository
     * @param TemaService $temaService
     */
    public function __construct(TemaRepository $temaRepository, TemaService $temaService)
    {
        $this->temaRepository = $temaRepository;
        $this->temaService = $temaService;
    }

    /**
     * @param string $nome
     * @param string $slugname
     * @return \App\Packages\Prova\Models\Tema
     */
    public function create(string $nome, string $slugname)
    {
        $tema = $this->temaService->create($nome, $slugname);
        $this->temaRepository->add($tema);
        return $tema;
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return $this->temaRepository->findAll();
    }
}