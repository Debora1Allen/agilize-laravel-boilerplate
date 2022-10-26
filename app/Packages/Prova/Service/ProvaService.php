<?php

namespace App\Packages\Prova\Service;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Templates\QuestaoProva;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\RespostasProvaDto;
use Doctrine\Common\Collections\ArrayCollection;


class ProvaService
{

    /**
     * @var TemaRepository
     */
    private TemaRepository $temaRepository;
    /**
     * @var QuestaoRepository
     */
    private QuestaoRepository $questaoRepository;

    /**
     * @param TemaRepository $temaRepository
     * @param QuestaoRepository $questaoRepository
     */
    public function __construct(TemaRepository $temaRepository, QuestaoRepository $questaoRepository)
    {
        $this->temaRepository = $temaRepository;
        $this->questaoRepository = $questaoRepository;
    }

    /**
     * @param Aluno $aluno
     * @param string $tema
     * @return Prova
     */
    public function create(Aluno $aluno, string $tema): Prova
    {
        $tema = $this->temaRepository->findOneBySlugname($tema);
        $questoesCollection = $this->questaoRepository->findRandomByTema($tema);
        $prova = new Prova($aluno, $tema);
        foreach ($questoesCollection as $questao) {
            /** @var Questao $questao */
            $this->questoes = new ArrayCollection;
            $questaoProva = new QuestaoProva($this, $questao->getPergunta());
            $questaoProva->setRespostas($questao->getRepostas());
            $this->questoes->add($questaoProva);
        }
        return $prova;
    }

    /**
     * @param Prova $prova
     * @param array $respostas
     * @return Prova
     */
    public function responder(Prova $prova, array $respostas): Prova
    {
        $respostasDtoCollection = collect();
        sort($respostas);
        foreach ($respostas as $resposta) {
            $respostasDtoCollection->add(new RespostasProvaDto($resposta['questaoId'], $resposta['respostaAluno']));
        }
        $prova->responder($respostasDtoCollection);
        return $prova;
    }
}