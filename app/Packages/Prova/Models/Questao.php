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
     * @ORM\OneToMany(targetEntity="App\Packages\Prova\Models\Resposta", fetch="EXTRA_LAZY", mappedBy="questao", cascade={"all"})
     */
    private ?Collection $alternativas;

    public function __construct(
        /**
         * @ORM\Id
         * @ORM\Column(name="id", type="guid")
         * @ORM\GeneratedValue(strategy="UUID")
         */
        protected string $id,

        /**
         * @ORM\ManyToOne(
         *     targetEntity="App\Packages\Prova\Models\Tema",
         *     inversedBy="questoes"
         * )
         */
        private Tema   $tema,

        /** @ORM\Column(type="string") */
        private string $pergunta,
    )
    {
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
            $this->alternativas->add(new Resposta(Str::uuid(), $this, $alternativa['alternativa'], $alternativa['isCorreta']));
        }
        $this->throwExceptionSeNaoExistirSomenteUmaAlternativaCorreta($alternativasCorretas);
    }

    private function throwExceptionSeNaoExistirSomenteUmaAlternativaCorreta(int $alternativasCorretas): void
    {
        if ($alternativasCorretas === 0) {
            throw new \Exception('A questão deve ter uma alternativa correta', 1663702752);
        }
        if ($alternativasCorretas > 1) {
            throw new \Exception('A questão só pode ter uma alternativa correta', 1663797428);
        }
    }
}


