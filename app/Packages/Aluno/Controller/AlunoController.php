<?php

namespace App\Packages\Aluno\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Aluno\Repository\AlunoRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psy\Util\Json;

class AlunoController extends Controller
{

    protected AlunoRepository $alunoRepository;

    /**
     * @param AlunoRepository $alunoRepository
     */
    public function __construct(AlunoRepository $alunoRepository)
    {
        $this->alunoRepository = $alunoRepository;
    }


    public function index()
    {
        $alunos = $this->alunoRepository->findAllAlunos();
        $alunosArray = collect();

        foreach ($alunos as $aluno){
            $alunosArray->add([
                'id' => $aluno->getId(),
                'telefone' => $aluno->getTelefone(),
                'email'  => $aluno->getEmail()
            ]);
        }
        return response()->json($alunosArray->toArray());
    }

    public function store()
    {

    }

    public function update()
    {

    }

    public function show()
    {

    }
}