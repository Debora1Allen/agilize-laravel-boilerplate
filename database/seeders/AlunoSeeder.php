<?php

namespace Database\Seeders;

use App\Packages\Aluno\Models\Aluno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AlunoSeeder extends Seeder
{
    /**
     * @var Aluno
     */
    protected Aluno $aluno;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nome = $this->aluno->getNome();
        EntityManager::persist(new Aluno($nome));

        EntityManager::flush();
    }
}
