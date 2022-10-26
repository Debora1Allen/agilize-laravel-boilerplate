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
    protected AlunoRepository $alunoRepository;
    protected AlunoFacade $alunoFacade;

    /**
     * @param AlunoRepository $alunoRepository
     * @param AlunoFacade $alunoFacade
     */
    public function __construct(AlunoRepository $alunoRepository, AlunoFacade $alunoFacade)
    {
        $this->alunoRepository = $alunoRepository;
        $this->alunoFacade = $alunoFacade;
    }

    public function index()
    {
        try {
            $alunos = $this->alunoFacade->findAll();
            return response()->json(['data' => AlunoResponse::collection($alunos)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733656);
        }
    }

    public function store(AlunoFormRequest $request)
    {
        try {
            $aluno = $this->alunoFacade->create($request->get('nome'));
            $this->alunoRepository->flush();
            return response()->json(['data' => AlunoResponse::item($aluno)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733670);
        }
    }

    public function listalunoProvas(Aluno $aluno)
    {
        try {
            $prova = $aluno->getProvas()->toArray();
            return response()->json(['data' => ProvaResponse::collection($prova)], 200);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733684);
        }
    }
}