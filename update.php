<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ferramenta para gerenciamento de banco de dados, tabela professores">
    <meta name="keywords" content="HTML, CSS, JavaScript, PHP, Manager, DataBase, SQL">
    <meta name="author" content="Kauê Delgado Pereira">
    <title>Gerenciador de dados - Update</title>
    <link rel="stylesheet" href="style.css" media="all">
</head>
<body>
    <?php
        include "./classes/Database.php";
        $db=Database::conexao();
        if(isset($_POST['atualizar'])){
            $nome = $_POST['nome'];
            $id = $_GET['codigo'];
            if($_GET['entity']=="professor"){
                try {
                    $stmt = $db->prepare('UPDATE professor SET professor.nome = :nome WHERE professor.codigo = :codigo');
                    $stmt->execute(array(
                    ':codigo'   => $id,
                    ':nome' => $nome
                    ));
                    echo '<script>
                    console.log("ok")
                    window.location.href="https://trabalhoscimol.000webhostapp.com/poo-bd-crud/index.php";
                    </script>';
                } catch(PDOException $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                
            }
            
        }
        
    ?>
    <h1>update: nome</h1>
    <form id="update" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <input type="text" value="<?php echo $_GET['name'];?>" name="nome">
        <input href="https://www.google.com" type="submit" name="atualizar" value="atualizar">
        

    </form>
</body>
</html>