<?php

namespace App\Packages\Aluno\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Aluno\Facade\AlunoFacade;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use App\Packages\Aluno\Request\AlunoFormRequest;
use App\Packages\Aluno\Response\AlunoResponse;
use App\Packages\Prova\Response\ProvaResponse;
use Exception;

class AlunoController extends Controller
{
    public function __construct(private AlunoRepository $alunoRepository, private AlunoFacade $alunoFacade)
    {
    }

    public function index()
    {
        try {
            $alunos = $this->alunoFacade->getAll();
            return response()->json(['data' => AlunoResponse::collection($alunos)], 200);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    public function store(AlunoFormRequest $request)
    {
        try {
            $aluno = $this->alunoFacade->create($request->get('nome'));
            $this->alunoRepository->flush();
            return response()->json(['data' => AlunoResponse::item($aluno)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    public function listProvas(Aluno $aluno)
    {
        try {
            $prova = $aluno->getProvas()->toArray();
            return response()->json(['data' => ProvaResponse::collection($prova)], HttpStatusConstants::OK);
        } catch (\Exception $exception) {
            return response()->json(ErrorResponse::item($exception), HttpStatusConstants::BAD_REQUEST);
        }
    }
}