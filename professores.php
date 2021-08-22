<?php
include "./classes/Database.php";
include "./classes/Professor.php";

$db = Database::conexao();
$Professor = new Professor();
$professores = $db->query("SELECT * FROM professor");


if (isset($_POST['save']) and $_POST['nome'] != '') {
    $Professor->save($_POST['nome']);
    header("Location: https://trabalhoscimol.000webhostapp.com/poo-bd-crud/index.php");
}

if (isset($_GET['delete'])) {
    $Professor->delete($_GET['delete']);
    header("Location: https://trabalhoscimol.000webhostapp.com/poo-bd-crud/index.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ferramenta para gerenciamento de banco de dados, tabela professores">
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
            <ul id="menu" style="display:none;" class="gx-0 flex-column">
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="index.php" id="linkMenu-1">inicio</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="professores.php" id="linkMenu-2">professores</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="turmas.php" id="linkMenu-3">turmas</a></li>
                <li class="linksMenu row gy-2 bg-secondary"><a class="bg-transparent p-0" href="alunos.php" id="linkMenu-4">alunos</a></li>
            </uil>
        </div>
        <h1>gerenciador de professores</h1>
        <form action='index.php' method='post'>
            <table class="col-10">
                <th class="col-5">codigo</th>
                <th class="col-5">nome</th>


                <?php
                $idProfessor = array();
                $nomeProfessor = array();
                while ($professor = $professores->fetch(PDO::FETCH_ASSOC)) {
                    echo "
                    <tr>
                        <td>{$professor['codigo']}</td>
                        <td>{$professor['nome']}
                            <a class='delete' href='https://trabalhoscimol.000webhostapp.com/poo-bd-crud/index.php?delete={$professor['codigo']}'>✕</a>
                            <a class='edit' href='https://trabalhoscimol.000webhostapp.com/poo-bd-crud/update.php?entity=professor&name={$professor['nome']}&codigo={$professor['codigo']}'>
                            ✍
                            </a>
                        </td>
                    </tr>";
                    array_push($idProfessor, $professor['codigo']);
                    array_push($nomeProfessor, $professor['nome']);
                }

                ?>
            </table>
            <input placeholder="digite o nome que quer adicionar" id="inputNome" pattern='^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$' required type='text' name='nome'>
            <input type='submit' name='save' value='save'>
        </form>

        <hr class="separador">
        <div class="footer-div row bg-secondary gx-0 col-12">
            <footer class="d-flex flex-row">
                <ul id="listFooter">
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
                <ul id="listFooterInf">
                    <li>
                        <p class="text-light"> Kauê Delgado Pereira</p>
                    </li>
                    <li>
                        <p class="text-light"><a class="text-info bg-transparent gx-0 fs-6" href="mailto:kauederp@gmail.com">kauederp@gmail.com</a></p>
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