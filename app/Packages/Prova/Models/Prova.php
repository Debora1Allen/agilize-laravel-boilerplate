<?php
//
//namespace App\Packages\Prova\Models;
//
//use App\Packages\Aluno\Models\Aluno;
//use Doctrine\ORM\Mapping as ORM;
//
///**
// * @ORM\Entity
// * @ORM\Table(name="prova")
// */
//class Prova
//{
// protected string $id;
// protected Aluno $aluno;
// protected Tema $tema;
// protected Questao $questao;
//
//    /**
//     * @param string $id
//     * @param Aluno $aluno
//     * @param Tema $tema
//     * @param Questao $questao
//     */
//    public function __construct(string $id, Aluno $aluno, Tema $tema, Questao $questao)
//    {
//        $this->id = $id;
//        $this->aluno = $aluno;
//        $this->tema = $tema;
//        $this->questao = $questao;
//    }
//
//    /**
//     * @return string
//     */
//    public function getId(): string
//    {
//        return $this->id;
//    }
//
//    /**
//     * @return Aluno
//     */
//    public function getAluno(): Aluno
//    {
//        return $this->aluno;
//    }
//
//    /**
//     * @return Tema
//     */
//    public function getTema(): Tema
//    {
//        return $this->tema;
//    }
//
//    /**
//     * @return Questao
//     */
//    public function getQuestao(): Questao
//    {
//        return $this->questao;
//    }
//
//}