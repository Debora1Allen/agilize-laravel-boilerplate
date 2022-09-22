<?php

namespace App\Packages\Prova\Models;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

class Resposta
{
    use TimestampableEntity;

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
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
     * @param string $id
     * @param string $texto
     * @param bool $correta
     */
    public function __construct(string $id, string $texto, bool $correta)
    {
        $this->id = $id;
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