<?php

namespace App\Packages\Aluno\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\AbstractRepository;

class AlunoRepository extends AbstractRepository
{
    public function findAllAlunos()
    {
        return $this->findAll();
    }

    public function createAluno(Aluno $aluno)
    {
        $this->getEntityManager()->persist($aluno);
        $this->getEntityManager()->flush();
        return $aluno;
    }

    public function findOneAlunoById(string $id): ?Aluno
    {
        return $this->findOneBy(['id' => $id]);
    }
}