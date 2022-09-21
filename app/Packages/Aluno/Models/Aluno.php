<?php

namespace App\Packages\Aluno\Models;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="aluno")
 */
class Aluno
{

    public function __construct()
    {
        $this->id = Str::uuid()->toString();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    protected string $id;


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}