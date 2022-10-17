<?php

namespace App\Packages\Prova\Models\Templates;

use App\Packages\Prova\Models\Prova;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="questoes_prova")
 */
class QuestaoProva
{
    use TimestampableEntity;

    /**
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Templates\RespostaProva", fetch="EXTRA_LAZY", mappedBy="questao", cascade={"all"})
     */
    private ?Collection $repostas;

    /** @ORM\Column(type="string") */
    private ?string $respostaCorreta;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Packages\Prova\Models\Prova",
     *     inversedBy="questoes"
     * )
     */
    private Prova $prova;

    /** @ORM\Column(type="string") */
    private string $pergunta;

    /** @ORM\Column(type="string", nullable=true) */
    private ?string $respostaAluno = null;


    /**
     * @param string $id
     * @param Prova $prova
     * @param string $pergunta
     * @param string|null $respostaAluno
     */

    public function __construct(Prova $prova, string $pergunta)
    {
        $this->id = Str::uuid();
        $this->repostas = new ArrayCollection;
        $this->respostaCorreta = null;
        $this->prova = $prova;
        $this->pergunta = $pergunta;
        $this->respostaAluno = null;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getPergunta(): string
    {
        return $this->pergunta;
    }

    public function getRepostas(): ?Collection
    {
        return $this->repostas;
    }

    public function setAlternativas($alternativas)
    {
        foreach ($alternativas as $alternativa) {
            if ($alternativa->isCorreta()) {
                $this->respostaCorreta = $alternativa->getAlternativa();
            }
            $this->repostas->add(new RespostaProva($this, $alternativa->getAlternativa(), $alternativa->isCorreta()));
        }
    }

    public function getRespostaAluno(): ?string
    {
        return $this->respostaAluno;
    }

    public function setRespostaAluno(string $respostaAluno): void
    {
        $this->respostaAluno = $respostaAluno;
    }

    public function getRespostaCorreta(): ?string
    {
        return $this->respostaCorreta;
    }
}