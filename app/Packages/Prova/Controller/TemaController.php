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
    public function __construct(private TemaRepository $temaRepository, private TemaFacade $temaFacade)
    {
    }

    public function index()
    {
        try {
            $temas = $this->temaFacade->getAll();
            return response()->json(['data' => TemaResponse::collection($temas)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function store(TemaRequest $request)
    {
        try {
            $tema = $this->temaFacade->create($request->get('nome'), $request->get('slugname'));
            $this->temaRepository->flush();
            return response()->json(['data' => TemaResponse::item($tema)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }
}