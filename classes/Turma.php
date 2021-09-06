<?php
/*
    Classe Turmas
    @author Kauê Delgado Pereira
    @copyright Kauê Delgado Pereira
    @version 1.0
    @package classes

*/

class Turma{
    /**
     * @nome $codigo
     * @access private
     */
    private $codigo;
    /**
     * @nome $curso
     * @access private
     */
    private $curso;
    /**
     * @nome $nome
     * @access private
     */
    private $nome;
    /**
     * @nome $professor
     * @access private
     */
    private $professor;
/**
    * Método setTurma
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @param int $codigo
    * @param string $curso
    * @param string $nome
    * @param string $professor
    * @return void

*/




    public function setTurma($codigo, $curso, $nome, $professor){
        $this->codigo=$codigo;
        $this->curso=$curso;
        $this->nome=$nome;
        $this->professor=$professor;
    }
/**
    * Método getCodigo()
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @return int

*/
    public function getCodigo(){
        return $this->codigo;
    }
/**
    * Método getNome() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @return string

*/
    public function getNome(){
        return $this->nome;
    }    
/**
    * Método getCurso() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @return string

*/
    public function getCurso(){
        return $this->curso;
    }
/**
    * Método getProfessor() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @return string

*/
    public function getProfessor(){
		return $this->professor;
    }

/**
    * Método listar() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @return object

*/
    public static function listar(){
        $db=Database::conexao();
        $turmas=null;
        $retorno=$db->query("SELECT * FROM turma");
        
        while($item=$retorno->fetch(PDO::FETCH_ASSOC)){
            $professor=Professor::getProfessor($item['professor_codigo']);
            $turma=new Turma();
            $turma->setTurma($item['codigo'],$item['curso'],$item['nome'],$professor );
            
            $turmas[]=$turma;
        }

        return $turmas;
    }

/**
    * Método excluir() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @param int $codigo
    * @return boolean

*/
    public static function excluir($codigo){
        $db=Database::conexao();
        $turmas=null;
        if($db->query("DELETE FROM turma WHERE codigo=$codigo")){
            return true;
        }
        return false;
    }
/**
    * Método salvar() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @return boolean

*/
    public function salvar(){
        try{
            $db=Database::conexao();
            if(empty($this->codigo)){
                $stm=$db->prepare("INSERT INTO turma (nome, curso, professor_codigo) VALUES (:nome,:curso,:professor)");
                $stm->execute(array(":nome"=>$this->getNome(),":curso"=>$this->getCurso() ,":professor"=>$this->getProfessor()->getCodigo()));
            }else{
                $stm=$db->prepare("UPDATE turma SET nome=:nome,curso=:curso,professor_codigo=:professor_codigo WHERE codigo=:codigo");
                $stm->execute(array(":nome"=>$this->nome,":curso"=>$this->curso ,":professor_codigo"=>$this->professor->getCodigo(),":codigo"=>$this->codigo));
            }
            #ppegar o id do registro no banco de dados
            #setar o id do objeto
            return true;
        }catch(Exception $ex){
            echo $ex->getMessage()."<br>";
            return false;
        }
        return true;
    }
    /** 
    * Método getTurma() 
    * @author Kauê Delgado Pereira
    * @version 1.0
    * @param
    * @return boolean

*/

    public static function getTurma($codigo){
        $db=Database::conexao();
        $retorno=$db->query("SELECT * FROM turma WHERE codigo=$codigo");
        if($retorno){
            $item=$retorno->fetch(PDO::FETCH_ASSOC);
            $professor=Professor::getProfessor($item['professor_codigo']);
            $turma=new Turma();
            $turma->setTurma($item['codigo'],$item['curso'],$item['nome'],$professor );
           return $turma;
        }
        return $turma;
    }
}
