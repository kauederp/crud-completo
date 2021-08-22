<?php

class Turma{
    private $codigo;
    private $curso;
    private $nome;
    private $professor;

    public function setTurma($codigo, $curso, $nome, $professor){
        $this->codigo=$codigo;
        $this->curso=$curso;
        $this->nome=$nome;
        $this->professor=$professor;
    }

    public function getCodigo(){
        return $this->codigo;
    }
    public function getNome(){
        return $this->nome;
    }    
    public function getCurso(){
        return $this->curso;
    }
    public function getProfessor(){
        return $this->professor;
    }
    public function save($nome,$professor,$curso)
    {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("INSERT INTO `turma` ( `nome`, `professor_codigo`, `curso`) VALUES (:nome, :professor_codigo, :curso)");
        
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':professor_codigo', $professor);
            $stmt->bindParam(':curso', $curso);
            $stmt->execute();
        }catch(false) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function delete($codigo)
    {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("DELETE FROM turma WHERE turma.codigo = :codigo");
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}