<?php 

if (isset($_GET['acao'])) {
    if ($_GET['acao'] == "salvar") {
        if ($_POST['enviar-aluno']) {
            $turma = new Turma();
            $turma->setTurma($_POST['turma'], null, null, null);
            $aluno = new Aluno();
            $aluno->setAluno(
                $_POST['codigo'],
                $_POST['nome'],
                $_POST['matricula'],
                $_POST['turma']
            );

            if ($aluno->salvar()) {
                $msg['msg'] = "Registro Salvo com sucesso!";
                $msg['class'] = "success";
            } else {
                $msg['msg'] = "Falha ao salvar Registro!";
                $msg['class'] = "success";
            }
            $_SESSION['msgs'][] = $msg;
            unset($aluno);
        }
    } else if ($_GET['acao'] == "excluir") {
        if (isset($_GET['codigo'])) {
            if (Aluno::excluir($_GET['codigo'])) {
                $msg['msg'] = "Registro excluido com sucesso!";
                $msg['class'] = "success";
            } else {
                $msg['msg'] = "Falha ao excluir Registro!";
                $msg['class'] = "danger";
            }
            $_SESSION['msgs'][] = $msg;
        }
        header("location: index.php?pagina=alunos");
    } else if ($_GET['acao'] == "editar") {
        if (isset($_GET['codigo'])) {
            $aluno = Aluno::getAluno($_GET['codigo']);
        }
    }
}


if(!isset($aluno)){
    $aluno = new Aluno();
    $aluno->setAluno(null,null,null,new Turma());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <title>Alunos</title>
    </head>
<body>
    <table >
        <tr>
            <td>codigo</td>
            <td>nome</td>
            <td>matricula</td>
            <td>turma</td>
            <td>professor</td>
        </tr>
        <?php 
            $alunos=$aluno->listar();
            foreach($alunos as $aluno){
                echo $aluno;
            }
        ?>
    </table>
    <form action="?pagina=alunos" method="post">
        
        <label for="nome">nome</label>
        <input type="text" name="nome" value="<?php echo $_GET['nome']?>" id="nomeInput"><br>

        <label for="matricula">matricula</label>
        <input type="number" name="matricula" value="<?php echo $_GET['matricula']?>" id="matriculaInput"><br>

        <label for="turma">turma</label>
        <select name="turma" id="turmaSelect">
            <?php
                $turmas=Turma::listar();
                foreach($turmas As $turma){
                    echo "<option value='".$turma->getCodigo()."'>".$turma->getNome()."</option>";
                       
                }
                
            ?>
        </select>
        <input type="submit" class="btn btn-primary" name="enviar-aluno" value="Enviar"/>
    </form>
</body>
</html>
