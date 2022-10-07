<?php

namespace Database\Seeders;

use App\Packages\Prova\Models\Prova;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class ProvaSeeder extends Seeder
{
    /**
     * @var Prova
     */
    protected Prova $prova;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $aluno = $this->prova->getAluno();
      $tema =  $this->prova->getTema();
      $questao =  $this->prova->getQuestao();
      EntityManager::persist(new Prova($aluno,$tema, (int)$questao));

      EntityManager::flush();
    }
}
