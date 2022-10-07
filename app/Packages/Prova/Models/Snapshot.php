<?php

namespace App\Packages\Prova\Models;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

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
     * @var Prova
     */
    protected Prova $prova;
    /**
     * @var Questao
     */
    protected Questao $questao;
    /**
     * @var Resposta
     */
    protected Resposta $resposta;
}