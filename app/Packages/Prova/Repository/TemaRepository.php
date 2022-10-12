<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Tema;

class TemaRepository extends AbstractRepository
{

    public string $entityName = Tema::class;

    public function add(Tema $tema): Tema
    {
        $this->getEntityManager()->persist($tema);
        $this->getEntityManager()->flush();
        return $tema;
    }

    public function findOneTemaById(string $id): ?Tema
    {
        return $this->findOneBy(['id' => $id]);
    }
    public function findOneTemaByNome(string $nome): ?Tema
    {
        return $this->findOneBy(['nome' => $nome]);
    }
}