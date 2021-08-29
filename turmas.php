<?php
include "./classes/Database.php";
include "./classes/Turma.php";
include "./classes/Professor.php";

$db = Database::conexao();
$Turma = new Turma();
$turmas = $db->query("SELECT * FROM turma");
$Professor = new Professor();
$professores = $db->query("SELECT * FROM professor");
$_SESSION['lista_professores'] = $turmas;

if(isset($_POST['save']) and $_POST['nome']!='' and $_POST['professor']!='' and $_POST['curso']!=''){
    $Turma->save($_POST['nome'],$_POST['professor'],$_POST['curso']);
    header("Location: turmas.php");
}

if(isset($_GET['delete'])){
    $Turma->delete($_GET['delete']);
    header("Location: turmas.php");
}

$idProfessor = array();
$nomeProfessor = array();
while ($professor = $professores->fetch(PDO::FETCH_ASSOC)) {
    array_push($idProfessor,$professor['codigo']);
    array_push($nomeProfessor,$professor['nome']);
}   
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ferramenta para gerenciamento de banco de dados, tabela turmas">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, Manager, DataBase, SQL">
    <meta name="author" content="Kauê Delgado Pereira">
    <title>Gerenciador de dados - Escola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" media="all">

</head>

<body>
    <div class="conteiner-fluid">
        <div class="d-flex bg-dark text-light">
            <h2 class="d-inline col-10">logo</h2>
            <button id="btnMenu" onclick="menuAction()" class="d-inline ml-auto p-1 col-2">
                <i class="bi bi-list fs-1"></i>
            </button>

        </div>
        <div class="row col-12">
            <ul id="menu" class="gx-0 flex-column">
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="index.php" id="linkMenu-1">inicio</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="turmas.php" id="linkMenu-2">turmas</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="turmas.php" id="linkMenu-3">turmas</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="alunos.php" id="linkMenu-4">alunos</a></li>
            </ul>
        </div>
        <hr class="separador">
        
        <form action="turmas.php" method="post">
            <table class="col-10">
                <h1 class="table-title col-10">gerenciador de turmas</h1>
                <th class="col-5">codigo</th>
                <th class="col-5">nome</th>
                <th class="col-5">curso</th>
                <th class="col-5">professor</th>


                <?php
                function nomeProfessor($idProfessor, $nomeProfessor,$turma){
                    $cont = 0;
                    while($turma['professor_codigo']!= $idProfessor[$cont]){
                        $cont=$cont+1;
                    }
                    return $nomeProfessor[$cont];
                }
                while ($turma = $turmas->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                        <tr>
                            <td>{$turma['codigo']}</td>
                            <td>{$turma['nome']}</td>
                            <td>{$turma['curso']}</td>
                            <td>".nomeProfessor($idProfessor,$nomeProfessor,$turma)."
                                <a class='edit' href='http://localhost/meu-crud/update.php?entity=turma&name={$turma['nome']}&codigo={$turma['codigo']}&turma={$turma['nome']}&curso={$turma['curso']}&professor=".nomeProfessor($idProfessor,$nomeProfessor,$turma)."'>
                                    ✍
                                </a>
                                <a class='delete' href='http://localhost/meu-crud/turmas.php?delete={$turma['codigo']}'>
                                    ✕
                                </a>
                            </td>
                        </tr>";
                    
                    
                }         
                
                ?>
                
            </table>
            <input placeholder="nome da turma" id="inputNome" pattern='^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ 0-9-]+$' required type='text' name='nome'>
            <select name="professor" id="selectProfessor">
            <?php
                $i=0;
                while ($i<) {
                    echo "<option value='".$professor['codigo']."'>".nomeProfessor($idProfessor,$nomeProfessor,$turma)."</option>";
                }         
                
                ?>
            </select>
            <?php var_dump($professor['nome']);?>
            <select name="curso" id="selectCurso">
                <option value="Informática">INFORMÁTICA</option>
                <option value="Eletrônica">ELETRÔNICA</option>
            </select>
            <input type='submit' name='save' value='save'>

        </form>

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