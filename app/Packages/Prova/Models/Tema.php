<?php

namespace App\Packages\Prova\Models;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tema")
 */
class Tema
{
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
     * @param string $id
     * @param string $nome
     */
    public function __construct(string $id, string $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
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
    public function getNome(): string
    {
        return $this->nome;
    }
}