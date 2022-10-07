<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class AlunoSeeder extends Seeder
{
    /**
     * @var \App\Packages\Aluno\Models\Aluno
     */
    protected \App\Packages\Aluno\Models\Aluno $aluno;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nome = $this->aluno->getNome();
        $email = $this->aluno->getEmail();
        $telenone = $this->aluno->getTelefone();
        EntityManager::persist(new \App\Packages\Aluno\Models\Aluno($nome,$telenone, $email));

        EntityManager::flush();
    }
}
