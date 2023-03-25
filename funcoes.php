<?php

include('conexao.php');
date_default_timezone_set('America/Sao_Paulo');
$data_Atual = date("Y-m-d");
$hora_Atual = date("H:i:s");

function insertSemPaisAcessado($conexao,$data_Atual,$hora_Atual){
    try{
        $sql = "INSERT INTO acessos (data_acesso, hora_acesso) VALUES (:data_atual, :hora_atual)";            
        $insert = $conexao->prepare($sql);
        //Associando valores com placeholders para evitar sql injections
        $insert->bindValue(':data_atual',$data_Atual, PDO::PARAM_STR); //PARAM_STR = indica que o valor associado é uma String
        $insert->bindValue(':hora_atual',$hora_Atual, PDO::PARAM_STR);
        $insert->execute();

      } catch (PDOException $e){

        error_log("Erro na inserção: " . $e->getMessage());
        die("Ocorreu um erro ao inserir os dados. Por favor, tente novamente mais tarde.");
      }
}

function insertComPaisAcessado($conexao,$data_Atual,$hora_Atual, $pais_acessado){
  try{
      $sql = "INSERT INTO acessos (data_acesso, hora_acesso, pais_acessado) VALUES (:data_atual, :hora_atual, :pais_acessado)";            
      $insert = $conexao->prepare($sql);
      //Associando valores com placeholders para evitar sql injections
      $insert->bindValue(':data_atual',$data_Atual, PDO::PARAM_STR); //PARAM_STR = indica que o valor associado é uma String
      $insert->bindValue(':hora_atual',$hora_Atual, PDO::PARAM_STR);
      $insert->bindValue(':pais_acessado', $pais_acessado, PDO::PARAM_STR);
      $insert->execute();
    } catch (PDOException $e){
      "Erro na inserção: ". $e->getMessage();
    }
}

function criarSelectOption(){
  $url = "https://dev.kidopilabs.com.br/exercicio/covid.php?listar_paises=1";
  $paises = json_decode(file_get_contents($url),true);//Trazendo dados da URL para um array associativo
  foreach ($paises as $pais) {
    echo "<option value=\"$pais\">$pais</option>";
  }
}

?>