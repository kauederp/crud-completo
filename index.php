<?php
/*
    @author Kauê Delgado.
    @copyright GPL © 2006, kauê Delgado. 

*/







session_start(); // sessoes iniciam aqui
//include "config.php";

// função de carregamento automático
spl_autoload_register(function ($class_name){
    include "./classes/".$class_name.'.php';
});
$_SESSION['header'] = '
    <style>
        li a{
            text-decoration:none;
            font-weight:bold;
        }
        
    </style>
    <header style="min-height:50px;" class=" col-12 bg-dark">
        <nav id="menu" style="display:none;" class="row d-sm-block col-12 gx-0 ">
            <ul class="row d-sm-flex flex-sm-row-reverse gx-0 d-flex flex-column-reverse justify-content-center-sm">
                <li style="background-color:none;padding-left: 10px; " class=" m-3 col-sm-1 mx-4 row gx-0"><a class="row col-2" href="http://localhost/crud-completo/index.php?pagina=turmas" class="text-primary" id="linkHeader-4">Turmas</a></li>
                <hr class="d-block d-sm-none m-0" style="width:100%;text-align:left;margin-left:0; color:#fff;">
               
                <li style="background-color:none;padding-left: 10px; " class=" m-3 col-sm-1 mx-4 row gx-0"><a class="row col-2" href="http://localhost/crud-completo/index.php?pagina=alunos" class="text-primary" id="linkHeader-3">Alunos</a></li>
                <hr class="d-block d-sm-none m-0" style="width:100%;text-align:left;margin-left:0; color:#fff;">
               
                <li style="background-color:none;padding-left: 10px; " class=" m-3 col-sm-1 mx-4 row gx-0"><a class="row col-2" href="http://localhost/crud-completo/index.php?pagina=professores" class="text-primary" id="linkHeader-2">Professores</a></li>
                <hr class="d-block d-sm-none m-0" style="width:100%;text-align:left;margin-left:0; color:#fff;">
               
                <li style="background-color:none;padding-left: 10px; " class=" m-3 col-sm-1 mx-4 row gx-0"><a class="row col-2" href="http://localhost/crud-completo/index.php" class="text-primary" id="linkHeader-1">Inicio</a></li>
            </ul>
        </nav>
        <button class="d-sm-none" id="btn-menu" onclick="menuAction();" style="float:right;margin-top:3px;font-size: 40px;">
            <i class="bi bi-list"></i>
        </button>
    </header>
    <br/>
    <br/>
    <br/>
';
echo $_SESSION['header'];
if(isset($_GET['pagina'])){
    if($_GET['pagina']=="alunos")
        include "alunos.php";
    else if($_GET['pagina']=="professores")
        include "professores.php";
    else if($_GET['pagina']=="turmas")
        include "turmas.php";
    else
        include "erro_404.php";
}else{
    include "inicio.php";
}