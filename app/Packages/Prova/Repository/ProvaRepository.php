<?php

namespace App\Packages\Prova\Repository;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Base\Repository\AbstractRepository;
use App\Packages\Prova\Models\Prova;

class ProvaRepository extends AbstractRepository
{

    public string $entityName = Prova::class;

    public function add(Prova $prova):Prova
    {
        $this->getEntityManager()->persist($prova);
        $this->getEntityManager()->flush();
        return $prova;
    }

    public function upadate()
    {

    }
    public function findOneProvaById(string $id): ?Prova
    {
        return $this->findOneBy(['id' => $id]);
    }

    public function finalizaProva(Prova $prova, $nota, $dataFinalizacao)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->set('prova.nota', ':nota')
            ->set('prova.data_finalizada', ':data_finalizada')
            ->where('prova = :prova')
            ->setParameters([
                'prova' => $prova,
                'nota' => $nota,
                'data_finalizacao' => $dataFinalizacao,
            ])
            ->getQuery()
            ->execute();
    }

    public function calculaResultado()
    {

    }

}