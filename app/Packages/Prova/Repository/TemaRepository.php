<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Resposta;
use App\Packages\Prova\Models\Tema;

class TemaRepository extends AbstractRepository
{
    public function add(Tema $tema): Tema
    {
        $this->getEntityManager()->persist($tema);
        $this->getEntityManager()->flush();
        return $tema;
    }
}