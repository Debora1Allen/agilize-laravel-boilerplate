<?php

namespace App\Packages\Prova\Models;

use Doctrine\ORM\Mapping as ORM;
use Illuminate\Support\Str;
use mysql_xdevapi\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="questoes")
 */
class Questao
{
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
     * @ORM\ManyToOne(targetEntity="\App\Packages\Prova\Models\Prova", inversedBy="questao")
     */
    protected Prova $prova;


    /**
     * @param string $id
     * @param string $texto
     * @param Prova $prova
     */
    public function __construct(string $texto, Prova $prova)
    {
        $this->id = Str::uuid()->toString();
        $this->texto = $texto;
        $this->prova = $prova;

    }
}