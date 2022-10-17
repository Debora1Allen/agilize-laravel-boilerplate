<?php

namespace App\Packages\Prova;

class RespostasProvaDto
{
    public function __construct(private string $questaoId, private string $respostaAluno)
    {
    }

    public function getQuestaoId(): string
    {
        return $this->questaoId;
    }

    public function getRespostaAluno(): string
    {
        return $this->respostaAluno;
    }
}