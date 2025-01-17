<?php

namespace App\Packages\Prova\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="temas")
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
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Prova", mappedBy="tema")
     */
    protected ?Collection $provas;

    /**
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Questao", mappedBy="tema")
     */
    protected ?Collection $questoes;


        /** @ORM\Column(type="string") */
    protected string $nome;
        /** @ORM\Column(type="string") */
    protected string $slugname;

    /**
     * @param string $nome
     * @param string $slugname
     */
    public function __construct(string $nome, string $slugname)
    {
        $this->id = Str::uuid();
        $this->provas = new ArrayCollection;
        $this->questoes = new ArrayCollection;
        $this->nome = $nome;
        $this->slugname = $slugname;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getSlugname(): string
    {
        return $this->slugname;
    }
}


