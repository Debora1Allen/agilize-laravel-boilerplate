<?php

namespace App\Packages\Prova\Models\Templates;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class QuestaoProva

    /**
     * @ORM\Entity
     * @ORM\Table(name="questao_prova")
     */
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;


    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Prova", inversedBy="questao_prova")
     */
    protected Prova $prova;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    protected string $texto;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Prova
     */
    public function getProva(): Prova
    {
        return $this->prova;
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

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Tema", inversedBy="questao_prova")
     */
    protected Tema $tema;

    /**
     * @param string $id
     * @param Prova $prova
     * @param string $texto
     * @param Tema $tema
     */
    public function __construct(string $id, Prova $prova, string $texto, Tema $tema)
    {
        $this->id = $id;
        $this->prova = $prova;
        $this->texto = $texto;
        $this->tema = $tema;
    }
}