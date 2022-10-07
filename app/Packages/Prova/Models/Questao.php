<?php

namespace App\Packages\Prova\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity
 * @ORM\Table(name="questoes")
 */
class Questao
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
    protected string $texto;

    /**
     * @ORM\OneToMany(targetEntity="\AppPackages\Prova\Models\Resposta", mappedBy="questoes", cascade="persist")
     */
    protected Collection $resposta;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Tema", inversedBy="tema", cascade="persist")
     */
    protected Tema $tema;


    /**
     * @param string $texto
     * @param Tema $tema ;
     */
    public function __construct(string $texto, Tema $tema)
    {
        $this->id = Str::uuid()->toString();
        $this->texto = $texto;
        $this->tema = $tema;
        $this->resposta = new ArrayCollection();

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
    public function getTexto(): string
    {
        return $this->texto;
    }

    /**
     * @return Tema
     */
    public function getTema(): Tema
    {
        return $this->tema;
    }


}