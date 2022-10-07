<?php

namespace App\Packages\Prova\Models;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;
use mysql_xdevapi\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="tema")
 */
class Tema
{
    use TimestampableEntity;

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
     *  @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Questao", mappedBy="tema", cascade="persist")
     */
    protected Collection $questoes;

    /**
     * @param string $nome
     */
    public function __construct(string $nome)
    {
        $this->id = Str::uuid()->toString();
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