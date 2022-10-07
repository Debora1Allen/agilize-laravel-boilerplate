<?php

namespace App\Packages\Prova\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Repository\ProvaRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProvaController extends Controller
{
    protected ProvaRepository $provaRepository;

    /**
     * @param ProvaRepository $provaRepository
     */
    public function __construct(ProvaRepository $provaRepository)
    {
        $this->provaRepository = $provaRepository;
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
    public function store(Request $request):JsonResponse
    {
        try{
            $aluno = $request->get('aluno');
            $tema = $request->get('tema');
            $questao = $request->get('quantidade_questao');
            return response()->json($this->provaRepository->add(new Prova($aluno,$tema,$questao)), 201);

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

    public function calculaResultado()
    {

    }

    public function finalizaProva(Prova $prova, $nota, $dataFinalizacao)
    {
        $entityManager = $this->getEntityManager();
        $queryBuilder = $entityManager->createQueryBuilder();
        return $queryBuilder
            ->set('exam.score', ':score')
            ->set('exam.finished_at', ':finishedAt')
            ->where('exam = :exam')
            ->setParameters([
                'prova' => $prova,
                'nota' => $nota,
                'data_finalizacao' => $dataFinalizacao,
            ])
            ->getQuery()
            ->execute();
    }

}