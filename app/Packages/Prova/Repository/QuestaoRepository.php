<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Base\Repository\Repository;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;

class QuestaoRepository extends Repository
{

public string $entityName = Questao::class;


    public function findRandomByTema(Tema $tema): array
    {
        $query = $this->createQueryBuilder('questions')
            ->select('questions')
            ->where('questions.tema = :tema')
            ->andWhere('questions.alternativas IS NOT EMPTY')
            ->orderBy('RANDOM()')
            ->setParameter('tema', $tema)
            ->getQuery();
        return $query->getResult();
    }
}