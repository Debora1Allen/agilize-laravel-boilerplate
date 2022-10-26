<?php

namespace App\Packages\Prova\Controller;

use App\Http\Controllers\Controller;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Aluno\Repository\AlunoRepository;
use App\Packages\Prova\Facade\ProvaFacade;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\Request\EnviarProvaRequest;
use App\Packages\Prova\Request\ProvaFormRequest;
use App\Packages\Prova\Response\ProvaResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertDoesNotMatchRegularExpression;

/**
 *
 */
class ProvaController extends Controller
{


    /**
     * @var ProvaRepository
     */
    protected ProvaRepository $provaRepository;
    /**
     * @var ProvaFacade
     */
    protected ProvaFacade $provaFacade;

    /**
     * @param ProvaRepository $provaRepository
     * @param ProvaFacade $provaFacade
     */
    public function __construct(ProvaRepository $provaRepository, ProvaFacade $provaFacade)
    {
        $this->provaRepository = $provaRepository;
        $this->provaFacade = $provaFacade;
    }

    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function index()
    {
        try {
            $provas = $this->provaFacade->findAll();
            return response()->json(['data' => ProvaResponse::collection($provas)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733820);
        }
    }

    /**
     * @param Prova $prova
     * @return JsonResponse
     * @throws Exception
     */
    public function show(Prova $prova)
    {
        try {
            return response()->json(['data' => ProvaResponse::item($prova)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733831);
        }
    }

    /**
     * @param Aluno $aluno
     * @param ProvaFormRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(Aluno $aluno, ProvaFormRequest $request)
    {
        try {
            $prova = $this->provaFacade->create($aluno, $request->get('tema'));
            $this->provaRepository->flush();
            return response()->json(['data' => ProvaResponse::item($prova)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733845);
        }
    }

    /**
     * @param Prova $prova
     * @param EnviarProvaRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function enviarRepostas(Prova $prova, EnviarProvaRequest $request)
    {
        try {
            $prova = $this->provaFacade->responder($prova, $request->get('respostas'));
            $this->provaRepository->flush();
            return response()->json(['data' => ProvaResponse::item($prova)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666733861);
        }
    }
}