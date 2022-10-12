<?php

namespace App\Packages\Aluno\Facade;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;

class AlunoFacade
{
public function __construct(private AlunoRepository $alunoRepository)
{
}
    public function create(string $nome)
    {
        $aluno = new Aluno(Str::uuid(), $nome);
        $this->alunoRepository->add($aluno);
        return $aluno;
    }

    public function getAll()
    {
        return $this->alunoRepository->findAll();
    }

}