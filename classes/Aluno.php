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
    
    public static function getAluno($codigo) {
        $db = Database::conexao();
        $retorno = $db->query("SELECT * FROM aluno WHERE codigo=$codigo");
        if ($retorno) {
            $item = $retorno->fetch(PDO::FETCH_ASSOC);
            $turma = Turma::getTurma($item['turma_codigo']);
            $aluno = new Aluno();
            $aluno->setAluno(
                $item['codigo'], 
                $item['nome'], 
                $item['matricula'],
                $turma);
            return $aluno;
        }
        return false;
    }
    

    public static function listar(){
        $db=Database::conexao();
        $retorno=$db->query("SELECT * FROM aluno;");
        $item = array();
        
        
        
        while ($linha = $retorno->fetch(PDO::FETCH_ASSOC)) {
            $turmas=Turma::listar();
            foreach($turmas As $turma){
                if($turma->getCodigo() == $linha['turma_codigo'])
                $nomeProfessor = $turma->getProfessor()->getNome();
            }
            $turmas=Turma::listar();
            foreach($turmas As $turma){
                if($turma->getCodigo() == $linha['turma_codigo'])
                $nomeTurma = $turma->getNome();
            }
            array_push($item,"<tr>
            <td scope='col'>{$linha['codigo']}</td>
            <td scope='col'>{$linha['nome']}</td>
            <td scope='col'>{$linha['matricula']}</td>
            <td scope='col'>{$nomeTurma}</td>
            <td scope='col'>$nomeProfessor</td>
            <td scope='col'><a href='http://localhost/crud-completo/index.php?pagina=alunos&acao=editar&id={$linha['codigo']}&nome={$linha['nome']}&matricula={$linha['matricula']}'><i class='link-primary bi bi-pen-fill'></i></a></td>
            <td scope='col'><a href='http://localhost/crud-completo/index.php?pagina=alunos&acao=excluir&id={$linha['codigo']}'><i class='bi link-danger bi-trash-fill'></i></a></td>
            </tr>");
        }

        return $item;
    }

    public function salvar() {
        try {
            $db = Database::conexao();
            if (empty($this->codigo)) {
                $stm = $db->prepare("INSERT INTO aluno (nome, matricula, turma_codigo) VALUES (:nome,:matricula,:turma)");
                $stm->execute(array(
                    ":nome" => $this->getNome(), 
                    ":matricula" => $this->getMatricula(), 
                    ":turma" => $this->getTurma()->getCodigo()
                ));
            } else {
                $stm = $db->prepare("UPDATE aluno SET nome=:nome,matricula=:matricula,turma_codigo=:turma_codigo WHERE codigo=:codigo");
                $stm->execute(array(
                ":nome" => $this->nome, 
                ":matricula" => $this->matricula, 
                ":turma_codigo" => $this->turma->getCodigo(), 
                ":codigo" => $this->codigo
            ));
            }
            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage() . "<br>";
            return false;
        }
        return true;
    }


    public static function excluir($codigo) {
        $db = Database::conexao();
        if ($db->query("DELETE FROM aluno WHERE codigo=$codigo")) {
            return true;
        }
        return false;
    }

    

}
