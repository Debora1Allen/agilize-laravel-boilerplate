<?php

namespace App\Packages\Aluno\Models;

use App\Packages\Prova\Models\Prova;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;
use mysql_xdevapi\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="aluno")
 */
class Aluno
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\Column(type="string")
     */
    protected string $nome;

    /**
     *  @ORM\OneToMany(targetEntity="\App\Packages\Prova\Models\Prova", mappedBy="aluno")
     */
    protected Collection $prova;

    /**
     * @ORM\Column(type="integer")
     */
    protected int $telefone;

    public function __construct(string $nome, int $telefone)
    {
        $this->id = Str::uuid()->toString();
        $this->nome = $nome;
        $this->telefone = $telefone;
    }

    /**
     * @return int
     */
    public function getTelefone(): int
    {
        return $this->telefone;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}