<?php

namespace App\Packages\Aluno\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Base\Repository\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AlunoRepository extends Repository
{
    protected string $entityName = Aluno::class;
}