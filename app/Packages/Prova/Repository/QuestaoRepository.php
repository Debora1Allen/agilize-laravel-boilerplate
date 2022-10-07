<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;

class QuestaoRepository extends AbstractRepository
{

    protected Tema $tema;

    public function add(Questao $questao): Questao
    {
        $this->getEntityManager()->persist($questao);
        $this->getEntityManager()->flush();
        return $questao;
    }

    public function findTema()
    {
      return $this->tema->getNome();
    }

    public function randonQuestao($tema, $quantidadeQuestoes)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->select('questao')
            ->from($this->entityName, 'questao')
            ->where('questao.tema = :questao')
            ->setParameter('questao', $tema)
            ->orderBy('RANDOM()')
            ->setMaxResults($quantidadeQuestoes)
            ->getQuery()
            ->getResult();
    }
}