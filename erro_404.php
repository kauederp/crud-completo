<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> ERRO - Página Não Encontrada </title>
</head>
<body>
    <h1>
        Erro: página ou arquivo não encontrado.
    </h1>
</body>

<script>
    
    var i = 0
    var h1 = document.getElementsByTagName("h1")
    h1[0].style.color="black"
    setInterval(function(){ 
        if(h1[0].style.color=="black")
            h1[0].style.color="red"
        else
            h1[0].style.color="black"
        console.log(i++); 

    }, 300);

</script>
</html>
