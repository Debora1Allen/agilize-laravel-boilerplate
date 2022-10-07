<?php

namespace App\Packages\Prova\Models;

use App\Packages\Aluno\Models\Aluno;
use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;
use mysql_xdevapi\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="prova")
 */
class Prova
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;


    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Aluno\Models\Aluno", inversedBy="aluno")
     */
    protected Aluno $aluno;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Tema", inversedBy="tema", cascade="persist")
     */
    protected Tema $tema;


    /**
     *  @ORM\OneToMany(targetEntity="\App\Packages\Prova\Models\Resposta", mappedBy="questoes", cascade="persist")
     */
    protected Collection $questao;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $quantidadeQuestoes;

    /**
     * @ORM\Column(type="datetime")
     */
    protected \DateTime $dataFinalizacao;


    /**
     * @ORM\Column(type="integer", nullable= "true")
     */
    protected int $nota;


    /**
     * @param Aluno $aluno
     * @param Tema $tema
     * @param int $quantidadeQuestoes
     */
    public function __construct(Aluno $aluno, Tema $tema, int $quantidadeQuestoes)
    {
        $this->id = Str::uuid()->toString();;
        $this->aluno = $aluno;
        $this->tema = $tema;
        $this->quantidadeQuestoes = $quantidadeQuestoes;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Aluno
     */
    public function getAluno(): Aluno
    {
        return $this->aluno;
    }

    /**
     * @return Tema
     */
    public function getTema(): Tema
    {
        return $this->tema;
    }

    /**
     * @return Collection
     */
    public function getQuestao(): Collection
    {
        return $this->questao;
    }

    /**
     * @return int
     */
    public function getQuantidadeQuestoes(): int
    {
        return $this->quantidadeQuestoes;
    }

    /**
     * @return int
     */
    public function getNota(): int
    {
        return $this->nota;
    }

    /**
     * @return \DateTime
     */
    public function getDataFinalizacao(): \DateTime
    {
        return $this->dataFinalizacao;
    }

}