<?php

namespace Database\Seeders;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LaravelDoctrine\ORM\Facades\EntityManager;

class QuestaoSeeder extends Seeder
{
    /**
     * @var Questao
     */
    protected Questao $questao;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tema =  $this->questao->getTema();
      $pergunta = $this->questao->getPergunta();
      EntityManager::persist(new Questao($tema,$pergunta));

      EntityManager::flush();
    }
}
