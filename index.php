<!DOCTYPE html>
<html>
<title>API Covid-19 - Kidopi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="estilo.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<body>

<div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
  <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Fechar &times;</button>
  <h5>Escolha outro país...(Nomes em inglês)</h5>
  <?php

    include('conexao.php');
    date_default_timezone_set('America/Sao_Paulo');
    $data_Atual = date("Y-m-d");
    $hora_Atual = date("H:i:s");

    $url = "https://dev.kidopilabs.com.br/exercicio/covid.php?listar_paises=1";

    $paises = json_decode(file_get_contents($url),true);//Trazendo dados da URL para um array associativo

    foreach ($paises as $pais) {
      echo "<div class='div-paises'>";
      echo '<a href="OutroPais.php?pais='.$pais.'">'.$pais.'</a><br>';
      echo "</div>";
    }

    //Inserindo data e hora de acesso e país acessado no banco de dados
    try{
      $sql = "INSERT INTO acessos (data_acesso, hora_acesso,pais_acessado) VALUES (:data_atual, :hora_atual)";            
      $insert = $conexao->prepare($sql);
      //Associando valores com placeholders para evitar sql injections
      $insert->bindValue(':data_atual',$data_Atual, PDO::PARAM_STR); //PARAM_STR = indica que o valor associado é uma String
      $insert->bindValue(':hora_atual',$hora_Atual, PDO::PARAM_STR);
      $insert->execute();
      echo "banco de dados atualizado com sucesso!";
    
    } catch (PDOException $e){
      "Erro na inserção: ". $e->getMessage();
    }


  ?>
</div>

<div id="main">

<div class="w3-teal">
  <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1><a href="index3.php">API Covid-19 - Kidopi</a> <a href="index3.php" id="LinkPaginaInicial">Voltar a página inicial</a></h1>
  </div>
</div>

<h2>Informações Covid-19</h2>
<p>Escolha um país para encontrar informações sobre casos de Covid-19 registados nele</p>

  <div class="container">

    <div class="card-panel">
      <abbr title="Brasil"><a href="OutroPais.php?pais=Brazil"><img src="brasil.jpg" alt="Brazil flag" id="brasil" class="bandeira" onmouseover="fadeIn('brasil')" onmouseout="fadeOut('brasil')"></a></abbr>
    </div>
    <div class="card-panel">
      <abbr title="Canadá"><a href="OutroPais.php?pais=Canada"><img src="canada.png" alt="Canada flag"  id="canada" class="bandeira" onmouseover="fadeIn('canada')" onmouseout="fadeOut('canada')"></a></abbr>
    </div>
    <div class="card-panel">
      <abbr title="Austrália"><a href="OutroPais.php?pais=Australia"><img src="australia.jpeg" alt="Australia flag"  id="australia" class="bandeira" onmouseover="fadeIn('australia')" onmouseout="fadeOut('australia')"></a></abbr>
    </div>
    <div class="card-panel" id="card-plus">
    <abbr title="Escolher outro país"><a href="#" onclick="w3_open()"><img src="plus.png" alt="Brazil flag" id="plus" class="bandeira" ></a></abbr>
    </div>
  </div>

  <div id="content">
    <!-- This is where the page content will be loaded -->
  </div>

<script>
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

//Para
$(document).ready(function(){
   $('a').click(function(){
       $('#content').load($(this).attr('href'));
       return false;
   });
});

</script>

</body>
</html>
