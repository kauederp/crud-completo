<?php
require_once "./classes/Database.php";
class Professor{
    private $codigo;
    private $nome;
    public function __construct(){
        
    }

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

    public function salvar(){
        try{
            $db=Database::conexao();
            $stm=$db->prepare("INSERT INTO professor (nome) VALUES (:nome)");
            $stm->execute(array(":nome"=>$this->getNome()));
            #ppegar o id do registro no banco de dados
            #setar o id do objeto
        }catch(Exception $ex){
            echo $ex.getMessage()."<br>";
        }
        

    }

    public function delete(){

    }

    public static function listar(){
        $db=Database::conexao();
        $professores=null;
        $retorno=$db->query("SELECT * FROM professor");
        while($item=$retorno->fetch(PDO::FETCH_ASSOC)){
            $professor=new Professor();
            $professor->setProfessor($item['codigo'],$item['nome'] );
            
            $professores[]=$professor;
        }

        return $professores;
    }


    public static function getProfessor($codigo){
        $db=Database::conexao();
        $retorno=$db->query("SELECT * FROM professor WHERE codigo= $codigo");
        if($retorno){
            $item=$retorno->fetch(PDO::FETCH_ASSOC);
            $professor=new Professor();
            $professor->setProfessor($item['codigo'],$item['nome'] );
            return $professor;
        }
        return false;
    }
}
