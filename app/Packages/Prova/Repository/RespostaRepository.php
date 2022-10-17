<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Base\Repository\Repository;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Resposta;
use App\Packages\Prova\Models\Tema;

class RespostaRepository extends Repository
{
    public string $entityName = Resposta::class;

}