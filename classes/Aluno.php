<?php

class Aluno{
    private $codigo;
    private $nome;
    private $matricula;
    private $turma;

    public function setAluno($codigo,$nome,$matricula,$turma){
        $this->codio=$codigo;
        $this->nome=$nome;
        $this->matricula=$matricula;
        $this->turma=$turma;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getMatricula(){
        return $this->matricula;
    }

    public function getTurma(){
        return $this->turma;
    }

    public function save($nome,$matricula,$turma)
    {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("INSERT INTO aluno ( nome, matricula, turma_codigo) VALUES (:nome, :matricula, :turma_codigo)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':turma_codigo', $turma);
            $stmt->execute();
        }catch(false) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function delete($codigo)
    {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("DELETE FROM `aluno` WHERE `aluno`.`codigo` = :codigo ");
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}