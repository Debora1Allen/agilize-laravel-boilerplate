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
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Templates\RespostaProva", mappedBy="questoes_prova", cascade={"all"})
     */
    protected ?Collection $repostas;

    /** @ORM\Column(type="string") */
    protected string $respostaCorreta;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Packages\Prova\Models\Prova",inversedBy="questoes_prova")
     */
    protected Prova $prova;

    /** @ORM\Column(type="string") */
    protected string $texto;

    /** @ORM\Column(type="string", nullable=true) */
    protected string $respostaAluno;


    /**
     * @param Prova $prova
     * @param string $texto
     */

    public function __construct(Prova $prova, string $texto)
    {
        $this->id = Str::uuid();
        $this->repostas = new ArrayCollection;
        $this->respostaCorreta = null;
        $this->prova = $prova;
        $this->texto = $texto;
        $this->respostaAluno = null;
    }

    /**
     * @return string
     */
    public function getTexto(): string
    {
        return $this->texto;
    }


    public function getId(): string
    {
        return $this->id;
    }



    public function getRepostas(): ?Collection
    {
        return $this->repostas;
    }

    public function setRespostas($respostas)
    {
        foreach ($respostas as $resposta) {
            if ($resposta->isCorreta()) {
                $this->respostaCorreta = $resposta->getReposta();
            }
            $this->repostas->add(new RespostaProva($this, $resposta->getReposta(), $resposta->isCorreta()));
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