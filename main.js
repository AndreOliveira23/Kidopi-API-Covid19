function w3_open() {
    document.getElementById("main").style.marginLeft = "15%";
    document.getElementById("mySidebar").style.width = "15%";
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("openNav").style.display = 'none';
  }
  
  function w3_close() {
    document.getElementById("main").style.marginLeft = "0%";
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("openNav").style.display = "inline-block";
  }
  
  function fadeIn(pais){
    const bandeiraDoPais = document.getElementById(pais);
    bandeiraDoPais.style.filter = "grayscale(0%)";
  }
  
  function fadeOut(pais){
    const bandeiraDoPais = document.getElementById(pais);
    bandeiraDoPais.style.filter = "grayscale(100%)";
  }
  

  function verificar(){
    var pais1 = document.getElementById("pais1");
    var pais2 = document.getElementById("pais2");
    if(pais1.value == pais2.value){
      alert('Você deve selecionar dois países diferentes!!');
    }else{
      $.ajax({
      url: "bonus.php",
      type: "POST",
      data: { pais1: pais1, pais2: pais2 }
    });
    }
  }

  function paginaInicial(){
    window.location.href = "index.php";
  }

   //Função ara abrir as páginas php que tratam os dados dos países na div "conteúdo"

  function loadPage(event) {
    event.preventDefault(); 
    var url = "";
    if (event.target.className == 'bandeira'){
      event = event.target.parentNode;
      url = event['attributes']['href']['nodeValue'];
    } else {
      url = event.target.href;
    }
  
    var xhr = new XMLHttpRequest(); 
  
    xhr.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("content").innerHTML = this.responseText; 
      }
    };
  
    xhr.open("GET", url, true); 
    xhr.send(); 
} 