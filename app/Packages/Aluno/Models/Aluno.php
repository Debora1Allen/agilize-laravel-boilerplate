<?php

namespace App\Packages\Aluno\Models;

use App\Packages\Prova\Models\Prova;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;


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
     * @ORM\Column(type="integer")
     */
    protected int $telefone;

    /**
     * @var string
     */
    protected string $email;

    /**
     * @param string $nome
     * @param int $telefone
     * @param string $email
     */
    public function __construct(string $nome, int $telefone, string $email)
    {
        $this->id = Str::uuid()->toString();
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->email = $email;
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

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
}