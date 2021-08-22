function menuAction(){
    if(document.getElementById("menu").style.display == "none"){
        document.getElementById("menu").style.display = "flex";
        console.log("mostra")
    }else{
        document.getElementById("menu").style.display = "none";
        console.log("esconde")
    }
}