<?php
    include('conexao.php');
    include('footer.php');
   
    date_default_timezone_set('America/Sao_Paulo');
    $data_Atual = date("Y-m-d");
    $hora_Atual = date("H:i:s");
    $pais_acessado = $_GET["pais"];
    $pais_acessado = str_replace(" ","+",$pais_acessado);
    $url = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=".$pais_acessado;
    
    
    $dados = json_decode(file_get_contents($url),true);//Trazendo dados da URL para um array associativo

    //Usando foreach para somar os totais de confirmados e mortos
    $totalDeMortos;
    $totalDeCasosConfirmados;

    foreach($dados as $item){
      $totalDeMortos += $item["Mortos"];
      $totalDeCasosConfirmados += $item["Confirmados"];
    }

    ?>
   

    <div class="containerCards">
      
      <div class="card-somaTotal">
          <h4>País escolhido:</h4>
          <?php echo str_replace("+"," ",$pais_acessado); ?>
        </div>

      <div class="card-somaTotal">
        <h4>Total de casos confirmados no país</h4>
        <?php echo $totalDeCasosConfirmados ?>
      </div>

      <div class="card-somaTotal">
        <h4>Total de mortes confirmados no país</h4>
        <?php echo $totalDeMortos ?>
      </div>

    </div>
    
    <?php
    //Primeira linha da tabela
    echo '<table>';
    echo '<tr bgcolor="#f5b7b1">';
    echo '<td>Estado</td>';
    echo '<td>Casos confirmados</td>';
    echo '<td>Mortes confirmadas</td>';
    echo '</tr>';

    //Gerando linhas da tabela de acordo com o número de elementos no array 
    foreach ($dados as $estado) {
      echo '<tr>';
      echo '<td>' . $estado["ProvinciaEstado"] . '</td>'; // output first value
      echo '<td>' . $estado["Confirmados"] . '</td>'; // output second value
      echo '<td>' . $estado["Mortos"] . '</td>'; // output fourth value
      echo '</tr>';
    }
    echo '</table>';

  

    //Inserindo data e hora de acesso e país acessado no banco de dados
    try{
      $sql = "INSERT INTO acessos (data_acesso, hora_acesso,pais_acessado) VALUES (:data_atual, :hora_atual, :pais_acessado)";            
      $insert = $conexao->prepare($sql);
      //Associando valores com placeholders para evitar sql injections
      $insert->bindValue(':data_atual',$data_Atual, PDO::PARAM_STR); //PARAM_STR = indica que o valor associado é uma String
      $insert->bindValue(':hora_atual',$hora_Atual, PDO::PARAM_STR);
      $insert->bindValue(':pais_acessado',$pais_acessado, PDO:: PARAM_STR);
      $insert->execute();
  
    } catch (PDOException $e){
      "Erro na inserção: ". $e->getMessage();
    }
    

?>

  <footer class="footer">
    <?php footer(); ?>
  </footer>

</body>
</html>
