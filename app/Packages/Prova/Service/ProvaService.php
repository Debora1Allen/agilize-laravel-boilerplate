<?php

namespace App\Packages\Prova\Service;
use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;
use App\Packages\Prova\Models\Templates\QuestaoProva;
use App\Packages\Prova\Repository\QuestaoRepository;
use App\Packages\Prova\Repository\TemaRepository;
use App\Packages\Prova\RespostasProvaDto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Illuminate\Support\Str;

class ProvaService
{
    public function __construct(private TemaRepository $temaRepository, private QuestaoRepository $questaoRepository)
    {
    }

    public function create(Aluno $aluno, string $tema): Prova
    {
        $tema = $this->temaRepository->findOneBySlugname($tema);
        $this->throwExceptionSeTemaNaoExistir($tema);
        $numeroAleatorioDeQuestoes = rand(4, 20);
        $questoesCollection = $this->questaoRepository->findRandomByTemaAndLimit($tema, $numeroAleatorioDeQuestoes);
        $this->throwExceptionSeTemaNaoPossuirQuestoes($questoesCollection);
        $prova = new Prova($aluno, $tema);

        foreach ($questoesCollection as $questao) {
            /** @var Questao $questao */
            $this->questoes = new ArrayCollection;
            $questaoProva = new QuestaoProva($this, $questao->getPergunta());
            $questaoProva->setAlternativas($questao->getAlternativas());
            $this->questoes->add($questaoProva);
        }
        return $prova;
    }

    public function responder(Prova $prova, array $respostas): Prova
    {
        $this->throwExceptionSeProvaConcluida($prova);
        $this->throwExceptionSeQuantidadeRespostasDiferenteQuantidadePerguntas($prova->getQuestoes(), $respostas);
        $respostasDtoCollection = collect();
        sort($respostas);

        foreach ($respostas as $resposta) {
            $respostasDtoCollection->add(new RespostasProvaDto($resposta['questaoId'], $resposta['respostaAluno']));
        }

        $prova->responder($respostasDtoCollection);
        return $prova;
    }

    private function throwExceptionSeTemaNaoExistir(?Tema $tema): void
    {
        if (!$tema instanceof Tema) {
            throw new \Exception('O tema não existe.', 1663702757);
        }
    }

    private function throwExceptionSeTemaNaoPossuirQuestoes(array $questoesCollection): void
    {
        if (count($questoesCollection) === 0) {
            throw new \Exception('Não possuem questões para esse tema.', 1664391636);
        }
    }

    private function throwExceptionSeProvaConcluida(Prova $prova): void
    {
        if ($prova->getStatus() === Prova::CONCLUIDA) {
            throw new \Exception('Prova já concluída.', 1663702741);
        }
    }

    private function throwExceptionSeQuantidadeRespostasDiferenteQuantidadePerguntas(Collection $questoes, array $respostas): void
    {
        if ($questoes->count() !== count($respostas)) {
            throw new \Exception('Quantidade de respostas diferente da quantidade de perguntas.', 1664697689);
        }
    }
}