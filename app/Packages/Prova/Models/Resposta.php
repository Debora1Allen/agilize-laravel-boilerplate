<?php

namespace App\Packages\Prova\Models;

use App\Packages\Aluno\Models\Aluno;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

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
     * @var string
     * @ORM\Column(type="string")
     */
    protected string $texto;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    protected bool $correta;

    /**
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Questao", inversedBy="resposta")
     */
    protected Questao $questao;

    /**
     * @param string $id
     * @param string $texto
     * @param bool $correta
     */
    public function __construct(string $id, string $texto, bool $correta)
    {
        $this->id = Str::uuid()->toString();
        $this->texto = $texto;
        $this->correta = $correta;
    }

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
     * @return bool
     */
    public function isCorreta(): bool
    {
        return $this->correta;
    }
}