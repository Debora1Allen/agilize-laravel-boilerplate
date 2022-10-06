<?php

namespace App\Packages\Prova\Controller;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Resposta;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\RespostaRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RespostaController
{
    protected RespostaRepository $respostaRepository;

    /**
     * @param RespostaRepository $respostaRepository
     */
    public function __construct(RespostaRepository $respostaRepository)
    {
        $this->respostaRepository = $respostaRepository;
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
           $correta = $request->get('correta');
            return response()->json($this->respostaRepository->add(new Resposta($texto,$correta)), 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1665090977);
        }
    }
}