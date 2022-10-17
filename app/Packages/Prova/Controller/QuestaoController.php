<?php

namespace App\Packages\Prova\Controller;

use App\Packages\Prova\Models\Prova;
use App\Http\Controllers\Controller;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\QuestaoRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestaoController extends Controller
{
    public function __construct(private QuestaoRepository $questaoRepository, private QuestaoFacade $questaoFacade)
    {
    }

    public function index()
    {
        try {
            $questoes = $this->questaoFacade->getAll();
            return response()->json(['data' => QuestaoResponse::collection($questoes)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function show(Questao $questao)
    {
        try {
            return response()->json(['data' => QuestaoResponse::item($questao)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function store(QuestaoRequest $request)
    {
        try {
            $questao = $this->questaoFacade->create($request->get('temaSlugname'), $request->get('pergunta'));
            $this->questaoRepository->flush();
            return response()->json(['data' => QuestaoResponse::item($questao)], HttpStatusConstants::CREATED);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function createAlternativas(Questao $questao, AlternativaRequest $request)
    {
        try {
            $questao = $this->questaoFacade->addAlternativas($questao, $request->get('alternativas'));
            $this->questaoRepository->flush();
            return response()->json(['data' => QuestaoResponse::item($questao)], HttpStatusConstants::CREATED);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }
}

