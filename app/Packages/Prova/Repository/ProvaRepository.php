<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;

class ProvaRepository extends AbstractRepository
{

    public function createProva(Prova $prova)
    {
        $this->getEntityManager()->persist($prova);
        $this->getEntityManager()->flush();
        return $prova;
    }

    public function findOneProvaById(string $id): ?Prova
    {
        return $this->findOneBy(['id' => $id]);
    }
}