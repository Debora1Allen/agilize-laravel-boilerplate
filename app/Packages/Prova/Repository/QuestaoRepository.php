<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;

class QuestaoRepository extends AbstractRepository
{

public string $entityName = Questao::class;

    public function add(Questao $questao): Questao
    {
        $this->getEntityManager()->persist($questao);
        $this->getEntityManager()->flush();
        return $questao;
    }

    public function findOneTemaById(string $id): ?Tema
    {
        return $this->findOneBy(['id' => $id]);
    }
}