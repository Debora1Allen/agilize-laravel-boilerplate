<?php

namespace App\Packages\Prova\Controller;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Repository\ProvaRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RespostaController
{
    protected ProvaRepository $provaRepository;

    /**
     * @param ProvaRepository $provaRepository
     */
    public function __construct(ProvaRepository $provaRepository)
    {
        $this->provaRepository = $provaRepository;
    }


    public function show(Request $request)
    {
        $idProva = $request->get('id');
        $prova = $this->provaRepository->findOneProvaById($idProva);

        return response()->json($prova);
    }

    /**
     * @throws Exception
     */
    public function store(Request $request):JsonResponse
    {
        try{
            $aluno = $request->get('aluno');
            $tema = $request->get('tema');
            $questao = $request->get('questao');
            return response()->json($this->provaRepository->add(new Prova($aluno,$tema,$questao)), 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }
}