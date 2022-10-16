<?php

namespace App\Packages\Prova\Service;

use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\TemaRepository;

class TemaService
{
    public function __construct(private TemaRepository $temaRepository)
    {
    }

    public function create(string $nome, string $slugname): Tema
    {
        $tema = $this->temaRepository->findOneBySlugname($slugname);
        $this->throwExceptionSeTemaJaExistir($tema);
        $tema = new Tema(Str::uuid(), $nome, $slugname);
        return $tema;
    }

    private function throwExceptionSeTemaJaExistir(?Tema $tema): void
    {
        if ($tema instanceof Tema) {
            throw new \Exception('O tema já existe.', 1663702757);
        }
    }
}