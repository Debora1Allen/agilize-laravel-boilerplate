<?php

namespace App\Packages\Prova\Models;

use App\Packages\Aluno\Models\Aluno;
use App\Packages\Prova\Models\Templates\QuestaoProva;
use App\Packages\Prova\RespostaProva;
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

    /**
     * @ORM\OneToMany (targetEntity="QuestaoProva", mappedBy="prova", cascade={"all"})
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
         *     targetEntity="App\Packages\Aluno\Domain\Model\Aluno",
         *     inversedBy="provas"
         * )
         */
        private Aluno $aluno;

        /**
         * @ORM\ManyToOne(
         *     targetEntity="App\Packages\Tema\Domain\Model\Tema",
         *     inversedBy="provas"
         * )
         */
        private Tema $tema;

        /** @ORM\Column(type="float", nullable=true) */
        private ?float $nota = null;

        /** @ORM\Column(type="datetime", nullable=true) */
        private ?\DateTime $submetidaEm = null;

        /** @ORM\Column(type="string", options={"default":"Aberta"}) */
        private ?string $status = 'Aberta';

    /**
     * @param Collection $questoes
     * @param string $id
     * @param Aluno $aluno
     * @param Tema $tema
     * @param float|null $nota
     * @param \DateTime|null $submetidaEm
     * @param string|null $status
     */
    public function __construct(Collection $questoes, string $id, Aluno $aluno, Tema $tema, ?float $nota, ?\DateTime $submetidaEm, ?string $status)
    {
        $this->questoes = new ArrayCollection;
        $this->id = Str::uuid()->toString();
        $this->aluno = $aluno;
        $this->tema = $tema;
        $this->nota = $nota;
        $this->submetidaEm = $submetidaEm;
        $this->status = $status;
    }

    public function setQuestoes(array $questoesCollection)
    {
        foreach ($questoesCollection as $questao) {
            /** @var Questao $questao */
            $questaoProva = new QuestaoProva(Str::uuid(), $this, $questao->getPergunta());
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

    public function responder(Collection $respostas, QuestaoProva $questaoProva, RespostaProva $resposta, int &$questoesCorretas): int
    {
        $this->submetidaEm = now();
        $this->status = "Finalizada";

        $questoesCorretas = 0;
        $questoesProva = $this->questoes;

        foreach ($questoesProva as $key => $questaoProva) {
            /** @var QuestaoProva $questaoProva */
            $questaoProva->setRespostaAluno($respostas[$key]->getRespostaAluno());
            if ($questaoProva->getRespostaCorreta() === $resposta->getRespostaAluno()) {
                $questoesCorretas += 1;
            }
        }
        $this->nota = round($questoesCorretas * (10 / $this->questoes->count()), 1);
        return $questoesCorretas;
    }

}