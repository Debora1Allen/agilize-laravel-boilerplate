<?php

namespace App\Packages\Prova\Controller;

use App\Packages\Prova\Facade\QuestaoFacade;
use App\Packages\Prova\Models\Prova;
use App\Http\Controllers\Controller;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\ProvaRepository;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Request\QuestaoFormRequest;
use App\Packages\Prova\Request\RespostaFormRequest;
use App\Packages\Prova\Response\QuestaoResponse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class QuestaoController extends Controller
{
    /**
     * @var QuestaoRepository
     */
    protected QuestaoRepository $questaoRepository;
    /**
     * @var QuestaoFacade
     */
    protected QuestaoFacade $questaoFacade;

    /**
     * @param QuestaoRepository $questaoRepository
     * @param QuestaoFacade $questaoFacade
     */
    public function __construct(QuestaoRepository $questaoRepository, QuestaoFacade $questaoFacade)
    {
        $this->questaoRepository = $questaoRepository;
        $this->questaoFacade = $questaoFacade;
    }


    /**
     * @return JsonResponse
     * @throws Exception
     */
    public function index()
    {
        try {
            $questoes = $this->questaoFacade->getAll();
            return response()->json(['data' => QuestaoResponse::collection($questoes)]);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    /**
     * @param Questao $questao
     * @return JsonResponse
     * @throws Exception
     */
    public function show(Questao $questao)
    {
        try {
            return response()->json(['data' => QuestaoResponse::item($questao)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1664303115);
        }
    }

    /**
     * @param QuestaoFormRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(QuestaoFormRequest $request)
    {
        try {
            $questao = $this->questaoFacade->create($request->get('temaSlugname'), $request->get('texto'));
            $this->questaoRepository->flush();
            return response()->json(['data' => QuestaoResponse::item($questao)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666748988);
        }
    }

    /**
     * @param Questao $questao
     * @param RespostaFormRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function createRespostas(Questao $questao, RespostaFormRequest $request)
    {
        try {
            $questao = $this->questaoFacade->addRespostas($questao, $request->get('respostas'));
            $this->questaoRepository->flush();
            return response()->json(['data' => QuestaoResponse::item($questao)], 201);
        }catch (Exception $exception){
            throw new Exception($exception->getMessage(), 1666749054);
        }
    }
}

