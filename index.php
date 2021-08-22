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
   
<style>
    

    a{
        width: 100%;
        text-align:center;
        background-color:rgb(200,200,200);
        margin-top:5px;
        text-decoration:none;
        color:rgb(0,0,0);
        margin-right:0;
        font-size:25px;
        height:60px;
        padding-top:30px;
    }
  

</style>
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
            </ul>
        </div>
        <hr class="separador">
        <div id="btns" class="d-flex flex-column">
            <a class="p-2" href="professores.php">
            professores <img class="icone" src="imagens/teacher.svg">
            </a>
            <a class="p-2" href="turmas.php">
                turmas <img class="icone" src="imagens/alunos.svg">

            </a>
            <a class="p-2" href="alunos">
                alunos
                <i class="bi bi-book-fill icone"></i>
            </a>
        </div>
    </div>
    <hr class="separador">
    <div class=" footer-div row bg-secondary gx-0 col-12">
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

    <script src="script.js"></script>
</body>
</html>
