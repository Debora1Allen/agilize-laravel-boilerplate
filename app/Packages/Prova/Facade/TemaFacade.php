<?php

namespace App\Packages\Prova\Facade;

use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\Service\TemaService;

class TemaFacade
{
    public function __construct(private TemaRepository $temaRepository, private TemaService $temaService)
    {
    }

    public function create(string $nome, string $slugname)
    {
        $tema = $this->temaService->create($nome, $slugname);
        $this->temaRepository->add($tema);
        return $tema;
    }

    public function getAll(): array
    {
        return $this->temaRepository->findAll();
    }
}