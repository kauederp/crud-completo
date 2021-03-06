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
            <td>{$linha['codigo']}</td>
            <td>{$linha['nome']}</td>
            <td>{$linha['matricula']}</td>
            <td>{$nomeTurma}</td>
            <td>$nomeProfessor</td>
            <td><a href='http://localhost/crud-completo/index.php?pagina=alunos&acao=editar&id={$linha['codigo']}&nome={$linha['nome']}&matricula={$linha['matricula']}&turma={$linha['turma_codigo']}'><i class='link-primary bi bi-pen-fill'></i></a></td>
            <td><a href='http://localhost/crud-completo/index.php?pagina=alunos&delete={$linha['codigo']}'><i class='bi link-danger bi-trash-fill'></i></a></td>
            </tr>");
        }

        return $item;
    }

    public function salvar($nome, $matricula, $turma) {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("INSERT INTO aluno (nome, matricula, turma_codigo) VALUES (:nome,:matricula,:turma);");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':matricula', $matricula);
            $stmt->bindParam(':turma', $turma);
            $stmt->execute();
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    public static function delete($codigo) {
        try{
            $db=Database::conexao();
            $stmt = $db->prepare("DELETE FROM aluno WHERE aluno.codigo = :codigo");
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
            
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function update($codigo, $nome, $matricula, $turma) {
        try{
            $db=Database::conexao();
            $stmt= $db->prepare("UPDATE aluno SET nome=:codigo, nome=:nome, matricula=:matricula, turma_codigo=:turma WHERE codigo=:codigo ;");
            $stmt->execute(array(
                ':codigo' => $codigo,
                ':nome' => $nome,
                ':matricula' => $matricula,
                ':turma' => $turma
                ));
        }catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

}
