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
            $provas = $this->provaFacade->findAll();
            return response()->json(['data' => ProvaResponse::collection($provas)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    public function show(Prova $prova)
    {
        try {
            return response()->json(['data' => ProvaResponse::item($prova)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    public function store(Aluno $aluno, ProvaFormRequest $request)
    {
        try {
            $prova = $this->provaFacade->create($aluno, $request->get('tema'));
            $this->provaRepository->flush();
            return response()->json(['data' => ProvaResponse::item($prova)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    public function enviarRepostas(Prova $prova, EnviarProvaRequest $request)
    {
        try {
            $prova = $this->provaFacade->responder($prova, $request->get('respostas'));
            $this->provaRepository->flush();
            return response()->json(['data' => ProvaResponse::item($prova)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }
}