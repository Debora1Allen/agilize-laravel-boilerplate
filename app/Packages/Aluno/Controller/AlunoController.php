<?php

namespace App\Packages\Aluno\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use App\Packages\Aluno\Request\AlunoFormRequest;
use Exception;
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
        try{
            $alunos = $this->alunoRepository->findAllAlunos();
            $alunosArray = collect();

            foreach ($alunos as $aluno){
                $alunosArray->add([
                    'id' => $aluno->getId(),
                    'telefone' => $aluno->getTelefone(),
                    'email' => $aluno->getEmail(),
                ]);
            }
            return response()->json($alunosArray->toArray());

        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1665091293);
        }
    }

    /**
     * @throws Exception
     */
    public function store(Request $request):JsonResponse
    {
        try{
            $nome = $request->get('nome');
            $telefone = $request->get('telefone');
            $email = $request->get('email');
            return response()->json($this->alunoRepository->add(new Aluno($nome,$telefone, $email)), 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    public function update()
    {

    }

    public function show()
    {

    }
}