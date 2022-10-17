<?php

namespace App\Packages\Prova\Models\Templates;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;


/**
 * @ORM\Entity
 * @ORM\Table(name="resposta-prova")
 */
class RespostaProva
{

    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Packages\Prova\Models\Templates\QuestaoProva",
     *     inversedBy="resposta",
     * )
     */
    protected QuestaoProva $questao;

    /** @ORM\Column(type="string") */
    protected string $resposta;

    /** @ORM\Column(type="boolean") */
    protected bool $isCorreta;

    /**
     * @param QuestaoProva $questao
     * @param string $resposta
     * @param bool $isCorreta
     */
    public function __construct(QuestaoProva $questao, string $resposta, bool $isCorreta)
    {
        $this->id = Str::uuid();
        $this->questao = $questao;
        $this->resposta = $resposta;
        $this->isCorreta = $isCorreta;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return QuestaoProva
     */
    public function getQuestao(): QuestaoProva
    {
        return $this->questao;
    }

    /**
     * @return string
     */
    public function getResposta(): string
    {
        return $this->resposta;
    }

    /**
     * @return bool
     */
    public function isCorreta(): bool
    {
        return $this->isCorreta;
    }


}