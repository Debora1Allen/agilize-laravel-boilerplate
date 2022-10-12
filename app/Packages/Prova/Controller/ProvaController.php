<?php

namespace App\Packages\Prova\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\SnapshotRepository;
use App\Packages\Prova\Repository\TemaRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertDoesNotMatchRegularExpression;

class ProvaController extends Controller
{
    protected ProvaRepository $provaRepository;
    protected AlunoRepository $alunoRepository;
    protected  TemaRepository $temaRepository;
    protected Prova $prova;

    /**
     * @param ProvaRepository $provaRepository
     */
    public function __construct(ProvaRepository $provaRepository, AlunoRepository $alunoRepository,TemaRepository $temaRepository)
    {
        $this->provaRepository = $provaRepository;
        $this->alunoRepository = $alunoRepository;
        $this->temaRepository = $temaRepository;
    }


    public function show(Request $request)
    {
        try{
            $idProva = $request->get('id');
            $prova = $this->provaRepository->findOneProvaById($idProva);
            return response()->json($prova);

        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1665091313);
        }
    }

    /**
     * @throws Exception
     */
    public function store(Request $request)
    {
        try{
            $aluno = $this->getAluno($request);
            $tema = $this->getTema($request);
            $questao = $this->getQuantidadeQuestoes();
            return $this->provaRepository->add(new Prova($aluno,$tema,$questao));

        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1665091042);
        }
    }


    public function update(Request $request, $prova): JsonResponse
    {
        try{
            $result = $this->provaRepository->update($prova,
                $request->get('resposta'),
                $request->get('data_finalizacao'),
            );

            return response()->json($this->provaRepository->upadate($result), 200);
        }catch (\Exception $exception){
            throw new Exception($exception->getMessage(), 1665091042);
        }
    }


    public function getAluno(Request $request)
    {
         $nome = $request->get('nome');
        return $this->alunoRepository->findOneAlunoByNome($nome);
    }

    public function getTema(Request $request)
    {
         $nome = $request->get('nome');
        return $this->temaRepository->findOneTemaByNome($nome);
    }

    public function getQuantidadeQuestoes() : int
    {
        return rand(4,10);
    }
}