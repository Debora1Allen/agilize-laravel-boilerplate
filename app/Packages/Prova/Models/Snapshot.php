<?php

namespace App\Packages\Prova\Models;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="snapshot")
 */
class Snapshot
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Prova", inversedBy="resposta", cascade="prova")
     */
    protected Prova $prova;


    /**
     * @var
     */
    protected $createdAt;
    /**
     * @var
     */
    protected $updatedAt;



    /**
     * @ORM\Column(type="string")
     */
    protected string $questao;

    /**
     * @ORM\Column(type="string")
     */
    protected string $resposta;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $respostaCorreta;

    /**
     * @param Prova $prova
     * @param $createdAt
     * @param $updatedAt
     * @param string $questao
     * @param string $resposta
     * @param bool $respostaCorreta
     */
    public function __construct( Prova $prova, $createdAt, $updatedAt, string $questao, string $resposta, bool $respostaCorreta)
    {
        $this->id = Str::uuid()->toString();
        $this->prova = $prova;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->questao = $questao;
        $this->resposta = $resposta;
        $this->respostaCorreta = $respostaCorreta;
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
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getQuestao(): string
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
    public function isRespostaCorreta(): bool
    {
        return $this->respostaCorreta;
    }

}