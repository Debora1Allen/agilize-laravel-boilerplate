<?php

namespace App\Packages\Prova\Models\Templates;

use Doctrine\ORM\Mapping as ORM;

class RespostaProva
{
    public function __construct(
        /**
         * @ORM\Id
         * @ORM\Column(type="uuid", unique=true)
         * @ORM\GeneratedValue(strategy="CUSTOM")
         * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
         */
        private string  $id,

        /**
         * @ORM\ManyToOne(
         *     targetEntity="App\Packages\Prova\Domain\Model\QuestaoProva",
         *     fetch="EXTRA_LAZY",
         *     inversedBy="alternativas",
         * )
         */
        private QuestaoProva $questao,

        /** @ORM\Column(type="string") */
        private string  $alternativa,

        /** @ORM\Column(type="boolean") */
        private bool    $isCorreta,
    )
    {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestao(): QuestaoProva
    {
        return $this->questao;
    }

    public function getAlternativa(): string
    {
        return $this->alternativa;
    }

    public function isCorreta(): bool
    {
        return $this->isCorreta;
    }
}