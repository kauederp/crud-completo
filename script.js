function menuAction(){
    if(document.getElementById("menu").style.display == "none"){
        document.getElementById("menu").style.display = "flex";
        document.getElementById("btn-menu").innerHTML = '<i class="bi bi-x"></i>';
    }else{
        document.getElementById("menu").style.display = "none";
        document.getElementById("btn-menu").innerHTML = '<i class="bi bi-list"></i>';
    }
}
function update(){
    if(document.getElementById("update").style.display == "none"){
        document.getElementById("update").style.display = "block";
    }else{
        document.getElementById("update").style.display = "none";
    }
}

function corTabela(){
    linha = document.getElementsByTagName("tr");
    var i=0;
    while(i<linha.length){
        if(i%2!=0){
            linha[i].style.backgroundColor="#fff";
        }else{
            linha[i].style.backgroundColor="rgb(244,244,244)";
        }
        i++;    
    }    
}