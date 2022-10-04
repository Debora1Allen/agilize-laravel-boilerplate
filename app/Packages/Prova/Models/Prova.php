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
     * @ORM\ManyToOne(targetEntity="\App\Packages\Aluno\Models\Aluno", inversedBy="prova")
     */
    protected Aluno $aluno;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Tema", inversedBy="prova")
     */
    protected Tema $tema;


    /**
     *  @ORM\OneToMany(targetEntity="\App\Packages\Prova\Models\Questao", mappedBy="prova")
     */
    protected Collection $questao;

    /**
     * @param Aluno $aluno
     * @param Tema $tema
     * @param Collection $questao
     */
    public function __construct(Aluno $aluno, Tema $tema, Collection $questao)
    {
        $this->id = Str::uuid()->toString();;
        $this->aluno = $aluno;
        $this->tema = $tema;
        $this->questao = $questao;
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
     * @return Questao
     */
    public function getQuestao(): Questao
    {
        return $this->questao;
    }

}