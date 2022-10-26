<?php

namespace App\Packages\Prova;

/**
 *
 */
class RespostasProvaDto
{
    /**
     * @var string
     */
    protected string $questaoId;
    /**
     * @var string
     */
    protected string $respostaAluno;

    /**
     * @param string $questaoId
     * @param string $respostaAluno
     */
    public function __construct(string $questaoId, string $respostaAluno)
    {
        $this->questaoId = $questaoId;
        $this->respostaAluno = $respostaAluno;
    }

    /**
     * @return string
     */
    public function getQuestaoId(): string
    {
        return $this->questaoId;
    }

    /**
     * @return string
     */
    public function getRespostaAluno(): string
    {
        return $this->respostaAluno;
    }
}