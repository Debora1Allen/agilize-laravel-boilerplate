<?php

namespace App\Packages\Prova\Models;

use App\Packages\Aluno\Models\Aluno;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="repostas")
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
         * @ORM\ManyToOne(targetEntity="App\Packages\Prova\Models\Questao",inversedBy="repostas")
         */
        private Questao $questao;

        /** @ORM\Column(type="string") */
        private string $resposta;

        /** @ORM\Column(type="boolean") */
        private bool $isCorreta;

        /**
         * @param string $id
         * @param Questao $questao
         * @param string $resposta
         * @param bool $isCorreta
         */
        public function __construct(Questao $questao, string $resposta, bool $isCorreta)
        {
            $this->id = Str::uuid();
            $this->questao = $questao;
            $this->resposta = $resposta;
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

    public function getRespostas(): string
    {
        return $this->resposta;
    }

    public function isCorreta(): bool
    {
        return $this->isCorreta;
    }


}
