<?php

namespace Database\Seeders;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Questao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
      $texto = $this->questao->getTexto();
      $tema =  $this->questao->getTema();
      EntityManager::persist(new Questao($texto,$tema));

      EntityManager::flush();
    }
}
