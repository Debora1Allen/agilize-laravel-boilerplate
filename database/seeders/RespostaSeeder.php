<?php

namespace Database\Seeders;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Resposta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LaravelDoctrine\ORM\Facades\EntityManager;

class RespostaSeeder extends Seeder
{
    /**
     * @var Resposta
     */
    protected Resposta $resposta;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $alternativa = $this->resposta->getAlternativa();
      $questao = $this->resposta->getQuestao();
      $correta = $this->resposta->isCorreta();
      EntityManager::persist(new Resposta($questao,$alternativa,$correta));
      EntityManager::flush();
    }
}
