<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;

class SnapshotRepository extends AbstractRepository
{

    public function add(Prova $prova):Prova
    {
        $this->getEntityManager()->persist($prova);
        $this->getEntityManager()->flush();
        return $prova;
    }
}