<?php
include "./Database.php";
class Professor{
    private $codigo;
    private $nome;
    
    public function setProfessor($codigo, $nome){
        $this->codigo=$codigo;
        $this->nome=$nome;
    }

    public function getCodigo(){
        return $this->codigo;
    }

    public function getNome(){
        return $this->nome;
    }

    public function save($nome)
    {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("INSERT INTO professor (nome) VALUES (:nome);");
            $stmt->execute(array(':nome' => $nome));
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

    }

    public function delete($codigo)
    {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("DELETE FROM professor WHERE professor.codigo = :codigo");
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
  
}