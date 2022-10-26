<?php

namespace App\Packages\Prova\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="questoes")
 */
class Questao
{
    use TimestampableEntity;

    /**
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Resposta",mappedBy="questao", cascade={"all"})
     */
    protected ?Collection $repostas;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Packages\Prova\Models\Tema", inversedBy="questoes")
     */
    protected Tema   $tema;

    /** @ORM\Column(type="string") */
    protected string $texto;

    /**
     * @param Tema $tema
     * @param string $pergunta
     */
    public function __construct( Tema $tema, string $texto)
    {
        $this->id = Str::uuid();
        $this->repostas = new ArrayCollection;;
        $this->tema = $tema;
        $this->texto = $texto;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getTema(): Tema
    {
        return $this->tema;
    }

    public function getTexto(): string
    {
        return $this->texto;
    }

    public function getRepostas(): Collection|array|null
    {
        return $this->repostas;
    }

    public function setRespostas(array $respostas)
    {
        $respostasCorretas = 0;
        foreach ($respostas as $resposta) {
            if($resposta['isCorreta'] === true) {
                $respostasCorretas++;
            }
            $this->repostas->add(new Resposta( $this, $resposta['resposta'], $resposta['isCorreta']));
        }
       return $respostasCorretas;
    }

}


