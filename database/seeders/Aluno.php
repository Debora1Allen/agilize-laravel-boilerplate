<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use LaravelDoctrine\ORM\Facades\EntityManager;

class Aluno extends Seeder
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

        $nome = $this->aluno->getNome() ;
        $telenone = $this->aluno->getTelefone();
        $email = $this->aluno->getEmail() ;
        EntityManager::persist(new \App\Packages\Aluno\Models\Aluno($nome,$email,$telenone));

        EntityManager::flush();
    }
}
