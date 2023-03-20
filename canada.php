<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>API-Covid-19 - Brasil</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
  <?php
    include('conexao.php');
    include('footer.php');
    date_default_timezone_set('America/Sao_Paulo');
    $data_Atual = date("Y-m-d");
    $hora_Atual = date("H:i:s");
    
    $pais_acessado = "Canadá";
    
    $url = "https://dev.kidopilabs.com.br/exercicio/covid.php?pais=Canada";

    $dados = json_decode(file_get_contents($url),true);//Trazendo dados da URL para um array associativo

    echo '<table>';
    echo '<tr>';
    echo '<td>Província</td>';
    echo '<td>Casos confirmados</td>';
    echo '<td>Mortes confirmadas</td>';
    echo '</tr>';

    foreach ($dados as $estado) {
      echo '<tr>';
      echo '<td>' . $estado["ProvinciaEstado"] . '</td>'; // output first value
      echo '<td>' . $estado["Confirmados"] . '</td>'; // output second value
      echo '<td>' . $estado["Mortos"] . '</td>'; // output fourth value
      echo '</tr>';
    }
    echo '</table>';


    try{
      $sql = "INSERT INTO acessos (data_acesso, hora_acesso,pais_acessado) VALUES (:data_atual, :hora_atual, :pais_acessado)";
              
      $insert = $conexao->prepare($sql);
  
      //Associando valores com placeholders para evitar sql injections
      $insert->bindValue(':data_atual',$data_Atual, PDO::PARAM_STR); //PARAM_STR = indica que o valor associado é uma String
      $insert->bindValue(':hora_atual',$hora_Atual, PDO::PARAM_STR);
      $insert->bindValue(':pais_acessado',$pais_acessado, PDO:: PARAM_STR);
      $insert->execute();
      echo "banco de dados atualizado com sucesso!";

    } catch (PDOException $e){
          "Erro na inserção: ". $e->getMessage();
    }

  ?>    
  <footer>
      Data do último acesso à API: <?php  include('footer.php'); echo $data ?> | País escolhido para a consulta: <?php echo $pais. "(Antes desse: ".$pais_anterior.")"  ?>
  </footer>

</body>
</html>
