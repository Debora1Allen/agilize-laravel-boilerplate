<?php

namespace App\Packages\Aluno\Models;

use App\Packages\Prova\Models\Prova;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="alunos")
 */
class Aluno
{
    use TimestampableEntity;

    /**
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Prova" , mappedBy="aluno")
     */
    protected Collection $provas;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

        /** @ORM\Column(type="string") */
    protected string $nome;

    /**
     * @param string $id
     * @param string $nome
     */
    public function __construct(string $nome)
    {
        $this->id = Str::uuid();
        $this->nome = $nome;
        $this->provas = new ArrayCollection;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getProvas(): Collection
    {
        return $this->provas;
    }

}