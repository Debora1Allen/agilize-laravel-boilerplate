<?php

namespace App\Packages\Prova\Models;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Illuminate\Support\Str;

/**
 * @ORM\Entity
 * @ORM\Table(name="questoes")
 */
class Questao
{
    use TimestampableEntity;

    /**
     * @ORM\OneToMany(targetEntity="App\Packages\Questao\Domain\Model\Alternativa", fetch="EXTRA_LAZY", mappedBy="questao", cascade={"all"})
     */
    private ?Collection $alternativas;

    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected string $id;

    /**
     * @ORM\ManyToOne(
     *     targetEntity="App\Packages\Tema\Domain\Model\Tema",
     *     inversedBy="questoes"
     * )
     */
    private Tema $tema;

      /** @ORM\Column(type="string") */
        private string $pergunta;

    /**
     * @param Collection|null $alternativas
     * @param string $id
     * @param Tema $tema
     * @param string $pergunta
     */
    public function __construct( Tema $tema, string $pergunta)
    {
        $this->id = Str::uuid()->toString();
        $this->tema = $tema;
        $this->pergunta = $pergunta;
        $this->alternativas = new ArrayCollection;
    }


    public function getId(): string
    {
        return $this->id;
    }

    public function getTema(): Tema
    {
        return $this->tema;
    }

    public function getPergunta(): string
    {
        return $this->pergunta;
    }

    public function getAlternativas(): Collection|array|null
    {
        return $this->alternativas;
    }

    public function setAlternativas(array $alternativas)
    {
        $alternativasCorretas = 0;
        foreach ($alternativas as $alternativa) {
            if($alternativa['isCorreta'] === true) {
                $alternativasCorretas++;
            }
        }
       return $this->alternativas->add(new Resposta($this, $alternativa['alternativa'], $alternativa['isCorreta']));
    }
}


