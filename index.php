<?php
/*
    @author Kauê Delgado.
    @copyright GPL © 2006, kauê Delgado. 

*/







// função de carregamento automático
session_start(); // sessoes iniciam aqui
//include "config.php";
spl_autoload_register(function ($class_name){
    include "./classes/".$class_name.'.php';
});


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