<!DOCTYPE html>
<html>
<title>API Covid-19 - Kidopi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="estilo.css">
<script src="main.js"></script>
<body>

  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar" onmouseleave="w3_close()"> 
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Fechar &times;</button>
    <h5>Escolha outro país...(Nomes em inglês)</h5>
    <?php

      include('conexao.php');
      include('funcoes.php');
      date_default_timezone_set('America/Sao_Paulo');
      $data_Atual = date("Y-m-d");
      $hora_Atual = date("H:i:s");
      insertSemPaisAcessado($conexao,$data_Atual,$hora_Atual);
      
      $url = "https://dev.kidopilabs.com.br/exercicio/covid.php?listar_paises=1";
      
      $paises = json_decode(file_get_contents($url),true);//Trazendo dados da URL para um array associativo
      
      //Criando barra lateral com todos os países
     
      foreach ($paises as $pais) {
        echo "<div class='div-paises'>";
        $pais2 = str_replace(" ", "+",$pais);
        echo '<a href="OutroPais.php?pais='.$pais2.'" onclick="loadPage(event)">'.$pais.'</a><br>';  
        echo "</div>";
      }
     
    ?>
  </div>

  <div id="main">

    <div class="w3-teal">
      <button id="openNav" class="w3-button w3-teal w3-xlarge" onclick="w3_open()">&#9776;</button>
      <div class="w3-container">
        <h1><a href="#" onclick="paginaInicial()">API Covid-19 - Kidopi</a> <a href="#" id="LinkPaginaInicial" onclick="paginaInicial()">Voltar a página inicial</a></h1>
      </div>
    </div>

    <div class="info">
      <div id="left-info"></div><h2 class="title">Informações Covid-19</h2></p>
      <p>Escolha um país para encontrar informações sobre casos de Covid-19 registados nele</p>
    </div>

    <div class="container">

      <div class="card-bandeira">
        <abbr title="Brasil"><a href="OutroPais.php?pais=Brazil" onclick="loadPage(event)" ><img src="brasil.jpg" alt="Bandeira do Brasil" id="brasil" class="bandeira" onmouseover="fadeIn('brasil')" onmouseout="fadeOut('brasil')"></a></abbr>
      </div>
      <div class="card-bandeira">
        <abbr title="Canadá"><a href="OutroPais.php?pais=Canada" onclick="loadPage(event)"><img src="canada.png" alt="Bandeira do Canadá"  id="canada" class="bandeira" onmouseover="fadeIn('canada')" onmouseout="fadeOut('canada')"></a></abbr>
      </div>
      <div class="card-bandeira">
        <abbr title="Austrália"><a href="OutroPais.php?pais=Australia" onclick="loadPage(event)"><img src="australia.jpeg" alt="Bandeira da austrália"  id="australia" class="bandeira" onmouseover="fadeIn('australia')" onmouseout="fadeOut('australia')"></a></abbr>
      </div>
      <div class="card-bandeira" id="card-simbolo-adicionar">
      <abbr title="Escolher outro país"><a href="#" onclick="w3_open()"><img src="plus.png" alt="Símbolo de 'adicionar' " id="simbolo-adicionar" class="bandeira" ></a></abbr>
      </div>

    </div>


  <div id="content"></div>

    <div class="info" id="extra">
      <div id="left-info"></div><span class="title" >Funcionalidade Extra...</span>
        <p>Você também pode verificar a diferença entre a taxa de morte entre dois países! Selecione- os nas listas abaixo e clique em "Verificar". (NOTA: Os nomes estão em inglês)</p>
        <div class="actions">
          <form action="bonus.php" method="POST" id="form">

            <!-- Select do país 1 -->
            <select id="pais1" name="pais1">
              <?php
                criarSelectOption();
              ?>
            </select>

            <!-- Select do país 2 -->
            <select id="pais2" name="pais2">
              <?php
                criarSelectOption();
              ?>
            </select>
            <input type="submit" class="botaoVerificar" value="Verificar" onclick="verificar()">
          </form>
        </div>
    </div>  
</body>
</html>
