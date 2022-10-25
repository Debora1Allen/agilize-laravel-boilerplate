<?php

namespace App\Packages\Aluno\Facade;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use Illuminate\Support\Str;

class AlunoFacade
{
    public function __construct(private AlunoRepository $alunoRepository)
    {
    }

    public function create(string $nome)
    {
        $aluno = new Aluno($nome);
        $this->alunoRepository->add($aluno);
        return $aluno;
    }

    public function findAll()
    {
        return $this->alunoRepository->findAll();
    }
}