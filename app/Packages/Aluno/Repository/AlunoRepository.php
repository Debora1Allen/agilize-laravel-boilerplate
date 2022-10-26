<?php

namespace App\Packages\Aluno\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\Repository;

class AlunoRepository extends Repository
{
    protected string $entityName = Aluno::class;
}