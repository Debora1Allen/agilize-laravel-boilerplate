<?php

namespace App\Packages\Prova\Models;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Templates\QuestaoProva;
use App\Packages\Prova\RespostasProvaDto;
use Carbon\Carbon;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;



/**
 * @ORM\Entity
 * @ORM\Table(name="provas")
 */
class Prova
{
    use TimestampableEntity;

    const NOTA_MAXIMA = 10.0;
    const CONCLUIDA = 'Concluida';
    const ABERTA = 'Aberta';
    const HORA_EM_SEGUNDOS = 3600;

    /**
     * @ORM\OneToMany (targetEntity="App\Packages\Prova\Models\Templates\QuestaoProva", mappedBy="prova", cascade={"all"})
     * @ORM\OrderBy({"id" = "ASC"})
     */
    private Collection $questoes;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

        /**
         * @ORM\ManyToOne(
         *     targetEntity="App\Packages\Aluno\Models\Aluno",
         *     inversedBy="provas"
         * )
         */
        private Aluno $aluno;

        /**
         * @ORM\ManyToOne(
         *     targetEntity="App\Packages\Prova\Models\Tema",
         *     inversedBy="provas"
         * )
         */
        private Tema $tema;

        /** @ORM\Column(type="float", nullable=true) */
        private float $nota;

        /** @ORM\Column(type="datetime", nullable=true) */
        private ?\DateTime $submetidaEm;

        /** @ORM\Column(type="string", options={"default":"Aberta"}) */
        private string $status;

    /**

     * @param Aluno $aluno
     * @param Tema $tema
     */
    public function __construct( Aluno $aluno, Tema $tema)
    {
        $this->questoes = new ArrayCollection;
        $this->id = Str::uuid();
        $this->aluno = $aluno;
        $this->tema = $tema;
        $this->nota = 0;
        $this->submetidaEm = null;
        $this->status = null;
    }


    public function setQuestoes(array $questoesCollection)
    {
        foreach ($questoesCollection as $questao) {
            /** @var Questao $questao */
            $questaoProva = new QuestaoProva($this, $questao->getPergunta());
            $questaoProva->setAlternativas($questao->getAlternativas());
            $this->questoes->add($questaoProva);
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNota(): ?float
    {
        return $this->nota;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getSubmetidaEm(): ?\DateTime
    {
        return $this->submetidaEm;
    }

    public function getQuestoes(): Collection
    {
        return $this->questoes;
    }

    public function getTema(): Tema
    {
        return $this->tema;
    }

    public function responder(\Illuminate\Support\Collection  $respostas): void
    {
        $this->submetidaEm = now();
        $this->status = self::CONCLUIDA;

        $this->throwExceptionIfProvaForaDoPrazo();

        $questoesCorretas = 0;
        $questoesCorretas = $this->verificaESetaRespostasCorretasDoAluno($respostas, $questoesCorretas);

        $this->calculaNotaProva($questoesCorretas);
    }

    private function throwExceptionIfProvaForaDoPrazo(): void
    {
        $submetidaEm = Carbon::instance($this->submetidaEm);
        if ($submetidaEm->diffInSeconds($this->createdAt) > self::HORA_EM_SEGUNDOS) {
            $this->nota = 0;
            throw new \Exception('Prova enviada fora do tempo limite.', 1663470013);
        }
    }

    private function verificaESetaRespostasCorretasDoAluno(Collection $respostas, int $questoesCorretas): int
    {
        $questoesProva = $this->questoes;

        foreach ($questoesProva as $key => $questaoProva) {
            /** @var QuestaoProva $questaoProva */
            $questaoProva->setRespostaAluno($respostas[$key]->getRespostaAluno());
            $this->somaSeRespostaAlunoForCorreta($questaoProva, $respostas[$key], $questoesCorretas);
        }

        return $questoesCorretas;
    }

    private function somaSeRespostaAlunoForCorreta(QuestaoProva $questaoProva, RespostasProvaDto $resposta, int &$questoesCorretas): void
    {
        if ($questaoProva->getRespostaCorreta() === $resposta->getRespostaAluno()) {
            $questoesCorretas += 1;
        }
    }

    private function calculaNotaProva(int $questoesCorretas): void
    {
        $this->nota = round($questoesCorretas * (self::NOTA_MAXIMA / $this->questoes->count()), 1);
    }
}