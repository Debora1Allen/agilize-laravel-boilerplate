<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;

class ProvaRepository extends AbstractRepository
{
    public string $entityName = Prova::class;
}