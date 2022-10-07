<?php

namespace App\Packages\Prova\Models\Templates;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use App\Packages\Prova\Models\Tema;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

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
     * @ORM\Column(type="string")
     */
    protected string $texto;

    /**

     * @ORM\Column(type="integer")
     */
    protected int $pesoQuestao;

    /**
     * @param string $id
     * @param Prova $prova
     * @param string $texto
     * @param int $pesoQuestao
     */
    public function __construct( Prova $prova, string $texto, int $pesoQuestao)
    {
        $this->id = Str::uuid()->toString();
        $this->prova = $prova;
        $this->texto = $texto;
        $this->pesoQuestao = $pesoQuestao;
    }

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
     * @return int
     */
    public function getPesoQuestao(): int
    {
        return $this->pesoQuestao;
    }


}