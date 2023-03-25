<!DOCTYPE html>
<html>
<title>API Covid-19 - Kidopi</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="estilo.css">
<script src="main.js"></script>
<body>

  <div class="w3-sidebar w3-bar-block w3-card w3-animate-left" style="display:none" id="mySidebar">
    <button class="w3-bar-item w3-button w3-large" onclick="w3_close()">Fechar &times;</button>
    <h5>Escolha outro país...(Nomes em inglês)</h5>
    <?php
        include('funcoes.php');
        include('footer.php');
        $pais1 = $_POST['pais1'];
        $pais2 = $_POST['pais2'];
        if ($pais1 == $pais2) {
            header('Location: index.php');
            exit();
        }
    ?>   
  </div>

  <div id="main">

    <div class="w3-teal">
      
      <div class="w3-container">
        <h1><a href="#" onclick="paginaInicial()">API Covid-19 - Kidopi</a> <a href="#" id="LinkPaginaInicial" onclick="paginaInicial()">Voltar a página inicial</a></h1>
      </div>
    </div>
    
    <div id="main">
    <?php

        date_default_timezone_set('America/Sao_Paulo');
        $data_Atual = date("Y-m-d");
        $hora_Atual = date("H:i:s");
       

        //Obtendo dados do país 1
        $url_pais1 = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$pais1."";
       // insertComPaisAcessado($conexao,$data_Atual,$hora_Atual,$pais1);
        $dados_pais1 = json_decode(file_get_contents($url_pais1),true);//Trazendo dados da URL para um array associativo
        //Usando foreach para somar os totais de confirmados e mortos
        $totalDeMortos_pais1;
        $totalDeCasosConfirmados_pais1;
        foreach($dados_pais1 as $item1){
            $totalDeMortos_pais1 += $item1["Mortos"];
            $totalDeCasosConfirmados_pais1 += $item1["Confirmados"];
        }
        $taxaDeMorte_pais1 = ($totalDeMortos_pais1 / $totalDeCasosConfirmados_pais1);

        //Obtendo dados do país 2
        $url_pais2 = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$pais2."";

        $dados_pais2 = json_decode(file_get_contents($url_pais2),true);//Trazendo dados da URL para um array associativo
        //insertComPaisAcessado($conexao,$data_Atual,$hora_Atual,$pais2);
        //Usando foreach para somar os totais de confirmados e mortos
        $totalDeMortos_pais2;
        $totalDeCasosConfirmados_pais2;
        foreach($dados_pais2 as $item2){
            $totalDeMortos_pais2 += $item2["Mortos"];
            $totalDeCasosConfirmados_pais2 += $item2["Confirmados"];
        }
        $taxaDeMorte_pais2 = ($totalDeMortos_pais2 / $totalDeCasosConfirmados_pais2);
        
        $diferenca = $taxaDeMorte_pais1 - $taxaDeMorte_pais2;

    ?>


    </div>

    <div class="containerCards">
      
      <div class="card-somaTotal">
          <h4>1º País escolhido:</h4>
          <?php echo $pais1; ?>
        </div>

      <div class="card-somaTotal">
        <h4>Total de casos confirmados no país</h4>
        <?php echo $totalDeCasosConfirmados_pais1?>
      </div>

      <div class="card-somaTotal">
        <h4>Total de mortes confirmados no país</h4>
        <?php echo $totalDeMortos_pais1 ?>
      </div>

      <div class="card-somaTotal">
          <h4>2º País escolhido:</h4>
          <?php echo $pais2; ?>
        </div>

      <div class="card-somaTotal">
        <h4>Total de casos confirmados no país</h4>
        <?php echo $totalDeCasosConfirmados_pais2 ?>
      </div>

      <div class="card-somaTotal">
        <h4>Total de mortes confirmados no país</h4>
        <?php echo $totalDeMortos_pais2 ?>
      </div>

      <div class="card-somaTotal">
        <h4>Diferença entre a taxa de mortes: </h4>
        <?php echo $diferenca ?>
      </div>

    </div>

<footer class="footer">
    <?php footer(); ?>
</footer>
</body>
</html>
