<?php

namespace App\Packages\Prova\Service;

use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\TemaRepository;

/**
 *
 */
class TemaService
{

    /**
     * @var TemaRepository
     */
    protected TemaRepository $temaRepository;

    /**
     * @param TemaRepository $temaRepository
     */
    public function __construct(TemaRepository $temaRepository)
    {
        $this->temaRepository = $temaRepository;
    }


    /**
     * @param string $nome
     * @param string $slugname
     * @return Tema
     */
    public function create(string $nome, string $slugname): Tema
    {
        $tema = new Tema($nome, $slugname);
        return $tema;
    }

}