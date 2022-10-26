<?php

namespace App\Packages\Prova\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Prova\Facade\TemaFacade;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Resposta;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\RespostaRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\Request\TemaFormRequest;
use App\Packages\Prova\Response\TemaResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemaController extends Controller
{
    public function __construct(private TemaRepository $temaRepository, private TemaFacade $temaFacade)
    {
    }

    public function index()
    {
        try {
            $temas = $this->temaFacade->getAll();
            return response()->json(['data' => TemaResponse::collection($temas)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666748818);
        }
    }

    public function store(TemaFormRequest $request)
    {
        try {
            $tema = $this->temaFacade->create($request->get('nome'), $request->get('slugname'));
            $this->temaRepository->flush();
            return response()->json(['data' => TemaResponse::item($tema)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }
}