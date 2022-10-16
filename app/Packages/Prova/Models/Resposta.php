<?php

namespace App\Packages\Prova\Models;

use App\Packages\Aluno\Models\Aluno;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="alternativas")
 */
class Resposta
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

        /**
         * @ORM\ManyToOne(targetEntity="App\Packages\Questao\Domain\Model\Questao", inversedBy="alternativas")
         */
        private Questao $questao;

        /** @ORM\Column(type="string") */
        private string  $escolhida;

        /** @ORM\Column(type="boolean") */
        private bool    $isCorreta;

    /**
     * @param Questao $questao
     * @param string $escolhida
     * @param bool $isCorreta
     */
    public function __construct($questao, string $escolhida, bool $isCorreta)
    {
        $this->id = Str::uuid()->toString();
        $this->questao = $questao;
        $this->escolhida = $escolhida;
        $this->isCorreta = $isCorreta;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestao(): Questao
    {
        return $this->questao;
    }

    public function getEscolhida(): string
    {
        return $this->escolhida;
    }

    public function isCorreta(): bool
    {
        return $this->isCorreta;
    }

}
