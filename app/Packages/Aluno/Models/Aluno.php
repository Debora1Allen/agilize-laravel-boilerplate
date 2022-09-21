<?php

namespace App\Packages\Aluno\Models;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
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
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected string $nome;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected string $email;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    protected int $telefone;

    public function __construct(string $nome, string $email, int $telefone)
    {
        $this->id = Str::uuid()->toString();
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
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