<?php

namespace App\Packages\Prova\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use App\Packages\Prova\Facade\ProvaFacade;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\SnapshotRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\Request\EnviarProvaRequest;
use App\Packages\Prova\Request\ProvaFormRequest;
use App\Packages\Prova\Response\ProvaResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertDoesNotMatchRegularExpression;

class ProvaController extends Controller
{
    public function __construct(private ProvaRepository $provaRepository, private ProvaFacade $provaFacade)
    {
    }

    public function index()
    {
        try {
            $provas = $this->provaFacade->getAll();
            return response()->json(['data' => ProvaResponse::collection($provas)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function show(Prova $prova)
    {
        try {
            return response()->json(['data' => ProvaResponse::item($prova)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function store(Aluno $aluno, ProvaRequest $request)
    {
        try {
            $prova = $this->provaFacade->create($aluno, $request->get('tema'));
            $this->provaRepository->flush();
            return response()->json(['data' => ProvaResponse::item($prova)], HttpStatusConstants::CREATED);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }

    public function enviarRepostas(Prova $prova, EnviarProvaRequest $request)
    {
        try {
            $prova = $this->provaFacade->responder($prova, $request->get('respostas'));
            $this->provaRepository->flush();
            return response()->json(['data' => ProvaResponse::item($prova)], HttpStatusConstants::CREATED);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }
}