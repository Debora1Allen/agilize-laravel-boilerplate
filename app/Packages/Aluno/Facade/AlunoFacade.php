<?php

namespace App\Packages\Aluno\Facade;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use Illuminate\Support\Str;

/**
 *
 */
class AlunoFacade
{

    /**
     * @var AlunoRepository
     */
    protected AlunoRepository $alunoRepository;

    /**
     * @param AlunoRepository $alunoRepository
     */
    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }

    /**
     * @param string $nome
     * @return Aluno
     */
    public function create(string $nome)
    {
        $aluno = new Aluno($nome);
        $this->alunoRepository->add($aluno);
        return $aluno;
    }

    /**
     * @return array|object[]
     */
    public function findAll()
    {
        return $this->alunoRepository->findAll();
    }
}