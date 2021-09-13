<?php 

if(isset($_GET['id'])){
    $_SESSION['codigo'] = $_GET['id'];
}

if(!isset($aluno)){
    $aluno = new Aluno();
    $aluno->setAluno(null,null,null,new Turma());
}

if(isset($_POST['editar-aluno']) and $_POST['nome']!='' and $_POST['matricula']!='' and $_POST['turma']!=''){
    $aluno->update($_SESSION['codigo'], $_POST['nome'], $_POST['matricula'], $_POST['turma']);
    unset($_SESSION['codigo']);
    header("Location: http://localhost/crud-completo/index.php?pagina=alunos&msg=edited");
    
}

if(isset($_POST['enviar-aluno']) and $_POST['nome']!='' and $_POST['matricula']!='' and $_POST['turma']!='' and !isset($_GET['acao'])){
    $aluno->salvar($_POST['nome'],$_POST['matricula'],$_POST['turma']);
    $_SESSION['msg'] = "ok";
    header("Location: http://localhost/crud-completo/index.php?pagina=alunos&msg=saved");
}


if(isset($_GET['delete'])){
    $aluno->delete($_GET['delete']);
    header("Location: http://localhost/crud-completo/index.php?pagina=alunos&msg=deleted");
}

if(isset($_GET['msg'])){
    if($_SESSION['msg']=="saved"){
        echo "<div class='p-2 bg-success' id='msgs'>";
        echo "<div class='text-light'>salvo com sucesso</div>";

    }else if($_GET['msg']=="edited"){
        echo "<div class='p-2 bg-warning' id='msgs'>";
        echo "<div class='text-light'>editado com sucesso</div>";
    
    }else if($_GET['msg']=="deleted"){
        echo "<div class='p-2 bg-danger' id='msgs'>";
        echo "<div class='text-light'>deletado com sucesso</div>";
    }
    
    
    echo "<script> 
    setTimeout(
        function(){
            document.querySelector('#msgs').remove();
        }
        ,
        2500
    );
    </script>";
    echo "</div>";
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
        <style>

        #form-aluno{
            padding-left:5vw;
        }
        input{
            width:93%;
        }
        td{
            min-width:100px;
        }
        #msgs{
            position: absolute;
            bottom:80px;
            right:10px;
            margin-top:90px;
        
        }
        .load{
            position: absolute;
            bottom:20px;
            right:10px;
            margin-top:90px;
            z-index: 999;
        }
        .enviar-btn{
                margin-top: 10px;
        }
        @media (min-width: 576px) {
            label{
                padding: 4px 0;

            }
            #formDiv2{
                margin-left:50px;
            }
            #form-aluno{    
                padding-left:35vw;
            }
            #div-enviar{
                margin-right:-40%;
            }
            .enviar-btn{
                width: 200px;
                
            }
            #msgs{
                position: absolute;
                bottom:80px;
                right:10px;

            }
            .load{
                position: absolute;
                bottom:20px;
                right:10px;
                margin-top:90px;
                z-index: 999;
            }
            td{
                width:100vw;
            }
        }
        </style>
    </head>
<body class="container-fluid gx-0 " onload="corTabela()">
    
    <form id="form-aluno" class="row col-12 bg-light gx-0" name="form-aluno" method="POST" action="?pagina=alunos">
        <div id="formDiv1" class=" d-none bg-light row  d-sm-flex flex-sm-column col-sm-2 col-12">
            <label for="nome">nome</label>
            <label for="matricula">matricula</label>
            <label for="turma">turma</label>
        </div>
        <div id="formDiv2" class="row  d-flex flex-column col-sm-3 col-12">
            <label class="d-sm-none "for="nome">nome</label>
            <input type="text" name="nome" value="<?php echo $_GET['nome']?>" id="nomeInput">
            <label class="d-sm-none "for="matricula">matricula</label>
            <input type="number" min="0" name="matricula" value="<?php echo $_GET['matricula']?>" id="matriculaInput">
            <label class="d-sm-none "for="turma">turma</label>
            <select name="turma" id="turmaSelect">
                <?php
                    $turmas=Turma::listar();
                    foreach($turmas As $turma){
                        echo "<option value='".$turma->getCodigo()."'>".$turma->getNome()."</option>";
                        
                    }
                    
                ?>
            </select>
           
        </div>
        <div id="div-enviar">
        <?php if(isset($_GET['acao'])){
            echo '<input type="submit" class="enviar-btn d-block btn btn-primary" name="editar-aluno" value="Editar"/>';
            }else{
                echo '<input type="submit" class=" enviar-btn d-block btn btn-primary" name="enviar-aluno" value="Enviar"/>';
            }
        ?></div>
    </form>
    <br>
    <table class="table row gx-0 overflow-auto" >
        <thead>
            <tr>
                <td class="bg-light">codigo</td>
                <td class="bg-light">nome</td>
                <td class="bg-light">matricula</td>
                <td class="bg-light">turma</td>
                <td class="bg-light">professor</td>
                <td class="bg-light">editar</td>
                <td class="bg-light">deletar</td>
            </tr>
        </thead>
        <tbody>
        <?php 
        echo "fo";
            $alunos=$aluno->listar();
            foreach($alunos as $aluno){
                echo $aluno;
                echo "<div class='p-2 bg-success load'>";
                echo "<div class='text-light'>carregado com sucesso</div>";
                    
                    
                    echo "<script> 
                    setTimeout(
                        function(){
                            document.querySelectorAll('.load')[0].remove();
                        }
                        ,
                        1500
                    );
                    </script>";
                    echo "</div>";
                }
        ?>
        </tbody>
    </table>
    <script src="script.js"></script>
</body>
</html>
