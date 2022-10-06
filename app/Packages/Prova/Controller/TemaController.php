<?php

namespace App\Packages\Prova\Controller;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Resposta;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\RespostaRepository;
use App\Packages\Prova\Repository\TemaRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemaController
{
    protected TemaRepository $temaRepository;

    /**
     * @param TemaRepository $temaRepository
     */
    public function __construct(TemaRepository $temaRepository)
    {
        $this->temaRepository = $temaRepository;
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
           $nome = $request->get('nome');
            return response()->json($this->temaRepository->add(new Tema($nome)));
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }
}