<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Resposta;

class RespostaRepository extends AbstractRepository
{
    public function add(Resposta $resposta): Resposta
    {
        $this->getEntityManager()->persist($resposta);
        $this->getEntityManager()->flush();
        return $resposta;
    }
}