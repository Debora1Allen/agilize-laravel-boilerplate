<?php

namespace Database\Seeders;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Resposta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
      $texto = $this->resposta->getTexto();
      $correta = $this->resposta->isCorreta();
      EntityManager::persist(new Resposta($texto,$correta));
      EntityManager::flush();
    }
}
