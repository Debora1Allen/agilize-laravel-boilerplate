<?php

namespace App\Packages\Prova\Controller;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\QuestaoRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestaoController
{

    protected QuestaoRepository $questaoRepository;

    /**
     * @param QuestaoRepository $questaoRepository
     */
    public function __construct(QuestaoRepository $questaoRepository)
    {
        $this->questaoRepository = $questaoRepository;
    }


    public function index(Request $request)
    {

    }

    /**
     * @throws Exception
     */
    public function store(Request $request):JsonResponse
    {
        try{
           $texto = $request->get('texto');
           $tema = $this->questaoRepository->findTema();
            return response()->json($this->questaoRepository->add(new Questao($texto,$tema)), 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1665091019);
        }
    }
}