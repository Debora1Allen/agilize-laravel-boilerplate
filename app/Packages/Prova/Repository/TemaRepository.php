<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Base\Repository\Repository;
use App\Packages\Prova\Models\Tema;

class TemaRepository extends Repository
{
    protected string $entityName = Tema::class;

    public function findOneBySlugname(string $slugname): ?Tema
    {
        return $this->findOneBy(['slugname' => $slugname]);
    }
}