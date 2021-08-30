<?php 
if(!isset($turma)){
    $alunos = new Aluno();
    $alunos->setAluno(null,null,null,new Turma());
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alunos</title>
</head>
<body>
    <table>
        <tr>
            <td>codigo</td>
            <td>nome</td>
        </tr>
        <?php echo "
            <td></td>
            <td></td>";?>
    </table>
</body>
</html>
