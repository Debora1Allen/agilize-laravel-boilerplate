<?php

namespace App\Packages\Prova\Models\Templates;

use App\Packages\Prova\Models\Questao;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class RespostaProva

    /**
     * @ORM\Entity
     * @ORM\Table(name="resposta_prova")
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
     * @var string
     */
    protected string $texto;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Templates\QuestaoProva", inversedBy="resposta_prova")
     */
    protected QuestaoProva $questaoProva;
    /**
     * @var bool
     */
    protected bool $escolhida;

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
     * @return QuestaoProva
     */
    public function getQuestaoProva(): QuestaoProva
    {
        return $this->questaoProva;
    }

    /**
     * @return bool
     */
    public function isEscolhida(): bool
    {
        return $this->escolhida;
    }

    /**
     * @param string $id
     * @param string $texto
     * @param QuestaoProva $questaoProva
     * @param bool $escolhida
     */
    public function __construct(string $id, string $texto, QuestaoProva $questaoProva, bool $escolhida)
    {
        $this->id = $id;
        $this->texto = $texto;
        $this->questaoProva = $questaoProva;
        $this->escolhida = $escolhida;
    }
}