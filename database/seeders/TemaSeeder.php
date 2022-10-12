<?php

namespace Database\Seeders;

use App\Packages\Prova\Models\Prova;
use App\Packages\Prova\Models\Resposta;
use App\Packages\Prova\Models\Tema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class TemaSeeder extends Seeder
{
    /**
     * @var Tema
     */
    protected Tema $tema;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $nome = $this->tema->getNome();
      EntityManager::persist(new Tema($nome));
      EntityManager::flush();
    }
}
