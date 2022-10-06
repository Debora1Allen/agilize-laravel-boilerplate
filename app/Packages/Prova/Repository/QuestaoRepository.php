<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;

class QuestaoRepository extends AbstractRepository
{
    public function add(Questao $questao): Questao
    {
        $this->getEntityManager()->persist($questao);
        $this->getEntityManager()->flush();
        return $questao;
    }

}