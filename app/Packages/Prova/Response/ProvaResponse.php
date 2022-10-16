<?php

namespace App\Packages\Prova\Response;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\RespostaProva;
use Doctrine\Common\Collections\Collection;

class ProvaResponse
{
    public function __construct(private TemaRepository $temaRepository, private QuestaoRepository $questaoRepository)
    {
    }

    public static function Collection($prova)
    {
    }

    public function create(Aluno $aluno, string $tema): Prova
    {
        $tema = $this->temaRepository->findOneBySlugname($tema);
        $numeroAleatorioDeQuestoes = rand(4, 20);
        $questoesCollection = $this->questaoRepository->findRandomByTemaAndLimit($tema, $numeroAleatorioDeQuestoes);
        $prova = new Prova($aluno, $tema);
        $prova->setQuestoes($questoesCollection);
        return $prova;
    }

    public function responder(Prova $prova, array $respostas): Prova
    {

        $respostasDtoCollection = collect();
        sort($respostas);

        foreach ($respostas as $resposta) {
            $respostasDtoCollection->add(new RespostaProva($resposta['questaoId'], $resposta['respostaAluno']));
        }

        $prova->responder($respostasDtoCollection);
        return $prova;
    }




}