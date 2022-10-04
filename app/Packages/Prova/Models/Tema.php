<?php

namespace App\Packages\Prova\Models;

use Doctrine\ORM\Mapping as ORM;
use mysql_xdevapi\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tema")
 */
class Tema
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected string $nome;

    /**
     *  @ORM\OneToMany(targetEntity="\App\Packages\Prova\Models\Prova", mappedBy="tema")
     */
    protected Collection $prova;

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