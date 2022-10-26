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
         *     targetEntity="App\Packages\Aluno\Models\Aluno",inversedBy="provas")
         */
    protected Aluno $aluno;

        /**
         * @ORM\ManyToOne(
         *     targetEntity="App\Packages\Prova\Models\Tema",inversedBy="provas")
         */
    protected Tema $tema;

        /** @ORM\Column(type="float", nullable=true) */
    protected float $nota;

        /** @ORM\Column(type="datetime", nullable=true) */
    protected ?\DateTime $submetidaEm;

        /** @ORM\Column(type="string", options={"default":"Aberta"}) */
    protected string $status;

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

    public function responder(\Illuminate\Support\Collection $respostas, RespostasProvaDto $respostasProvaDto = null): void
    {
        $this->submetidaEm = now();
        $this->status = self::CONCLUIDA;
        $questoesProva = $this->questoes;
        $questoesCorretas = 0;
        foreach ($questoesProva as $key => $questaoProva) {
            /** @var QuestaoProva $questaoProva */
            $questaoProva->setRespostaAluno($respostas[$key]->getRespostaAluno());
            if ($questaoProva->getRespostaCorreta() === $respostasProvaDto->getRespostaAluno()) {
                $questoesCorretas += 1;
            }
        }
        $this->nota = round($questoesCorretas * (self::NOTA_MAXIMA / $this->questoes->count()), 1);
    }

}