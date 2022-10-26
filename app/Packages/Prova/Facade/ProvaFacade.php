<?php

namespace App\Packages\Prova\Facade;


use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Service\ProvaService;

/**
 *
 */
class ProvaFacade
{

    /**
     * @var ProvaRepository
     */
    private ProvaRepository $provaRepository;
    /**
     * @var ProvaService
     */
    private ProvaService $provaService;

    /**
     * @param ProvaRepository $provaRepository
     * @param ProvaService $provaService
     */
    public function __construct(ProvaRepository $provaRepository, ProvaService $provaService)
    {
        $this->provaRepository = $provaRepository;
        $this->provaService = $provaService;
    }


    /**
     * @param Aluno $aluno
     * @param string $tema
     * @return Prova
     */
    public function create(Aluno $aluno, string $tema): Prova
    {
        $prova = $this->provaService->create($aluno, $tema);
        $this->provaRepository->add($prova);
        return $prova;
    }

    /**
     * @return array|object[]
     */
    public function findAll()
    {
        return $this->provaRepository->findAll();
    }

    /**
     * @param Prova $prova
     * @param array $respostas
     * @return Prova
     */
    public function responder(Prova $prova, array $respostas): Prova
    {
        $this->provaService->responder($prova, $respostas);
        $this->provaRepository->update($prova);
        return $prova;
    }

}

