<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ferramenta para gerenciamento de banco de dados, tabela professores">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, Manager, DataBase, SQL">
    <meta name="author" content="Kauê Delgado Pereira">
    <title>Gerenciador de dados - Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" media="all">
</head>
<body>
    <?php
        include "./classes/Database.php";
        include "./classes/Turma.php";
        include "./classes/Professor.php";
        include "./classes/Aluno.php";
        $db=Database::conexao();
        $Turma = new Turma();
        $turmas = $db->query("SELECT * FROM turma");
        $Professor = new Professor();
        $professores = $db->query("SELECT * FROM professor");
        $Aluno = new Professor();
        $alunos = $db->query("SELECT * FROM aluno");
        if(isset($_POST['atualizar'])){
            $nome = $_POST['nome'];
            $id = $_GET['codigo'];
            $matricula = $_GET['matricula'];
            $turma = $_GET['turma'];
            $professor = $_GET['professor'];
            $curso = $_GET['curso'];

            if($_GET['entity']=="professor"){
                try {
                    $stmt = $db->prepare('UPDATE professor SET professor.nome = :nome WHERE professor.codigo = :codigo');
                    $stmt->execute(array(
                    ':codigo'   => $id,
                    ':nome' => $nome
                    ));
                    echo '<script>
                    console.log("ok")
                    window.location.href="professores.php";
                    </script>';
                } catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                
            }
            if($_GET['entity']=="turma"){
                try {
                    $stmt = $db->prepare("UPDATE turma SET `nome` = :nome , `professor_codigo` = :professor, `curso` = :curso WHERE `turma`.`codigo` = :codigo");
                    
                    $stmt->execute(array(
                    ':nome' => $nome,
                    ':codigo' => $id,
                    ':professor'   => $professor,
                    ':curso'   => $curso,
                    ));
                    echo '<script>
                    console.log("ok")
                    window.location.href="turmas.php";
                    </script>';
                } catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                
            }
            
        }
        
    ?>
    <div class="conteiner-fluid">
        <div class="d-flex bg-dark text-light">
            <h2 class="d-inline col-10">logo</h2>
            <button id="btnMenu" onclick="menuAction()" class="d-inline ml-auto p-1 col-2">
                <i class="bi bi-list fs-1"></i>
            </button>

        </div>
        <div class="row col-12">
            <ul id="menu" style="display:none;" class="gx-0 flex-column">
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="index.php" id="linkMenu-1">inicio</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="professores.php" id="linkMenu-2">professores</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="turmas.php" id="linkMenu-3">turmas</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="alunos.php" id="linkMenu-4">alunos</a></li>
            </ul>
        </div>
        <hr class="separador">
    <form id="update" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
    <table class="col-10">
            <h1 class="table-title col-10">atualizar professor</h1>
            <th class="col-5">codigo</th>
            <th class="col-5">nome</th>
            <?php
                echo "                        <tr>
                            <td>".$_GET['codigo']."</td>
                            <td>".$_GET['name']."</td>
                        </tr>

                        ";
                

                if($_GET['entity']=="turma"){

                    echo "
                        <th class='col-5'>curso</th>
                        <th class='col-5'>professor</th>

                        <td>".$_GET['curso']."</td>
                        <td>".$_GET['professor']."</td>";
                        
                    

            
                   echo "</tr>

                </table>
                <input type='text' value='".$_GET["name"]."' name='nome'>
                <select name='professor' id='selectProfessor'>";
            
                        while ($professor = $professores->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$professor['codigo']."'>".$professor['nome']."</option>";
                        }         
                    echo "
                    </select>
                    <select name='curso' id='selectCurso'>
                        <option value='Informática'>INFORMÁTICA</option>
                        <option value='Eletrônica'>ELETRÔNICA</option>
                    </select>";
                }
        echo "</table>
                <input type='text' value='".$_GET["name"]."' name='nome'>";
            ?>
        <input  type="submit" name="atualizar" value="atualizar">
        <hr class="separador">
        <div class="footer-div row bg-secondary gx-0 col-12">
            <footer class="d-flex flex-row">
                <ul id="listFooter" class="listFooter">
                    <li>
                        <p class="text-light">autor: </p>
                    </li>
                    <li>
                        <p class="text-light">email: </p>
                    </li>
                    <li>
                        <p class="text-light">contatato: </p>
                    </li>
                </ul>
                <ul id="listFooterInf" class="listFooter">
                    <li>
                        <p class="text-light"> Kauê Delgado Pereira</p>
                    </li>
                    <li>
                        <a class="text-info bg-transparent gx-0" href="mailto:kauederp@gmail.com">kauederp@gmail.com</a>
                    </li>
                    <li>
                        <p class="text-light"> +55 51 995978589</p>
                    </li>
                </ul>
            </footer>
        </div>
    </div>
    <script src="script.js"></script>
    
</body>

</html>
