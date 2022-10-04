<?php

namespace App\Packages\Aluno\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\AbstractRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlunoRepository extends AbstractRepository
{
    public string $entityName = Aluno::class;

    public function findAllAlunos()
    {
        return $this->findAll();
    }

    public function add(Aluno $aluno):Aluno
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