<?php
include('conexao.php');

$select = $conexao->prepare("SELECT * FROM acessos ORDER BY id_acesso DESC");
$select->execute();
$resultado = $select->fetchAll(PDO::FETCH_ASSOC);
$data = date("d-m-Y",strtotime($resultado[0]["data_acesso"]));
$pais = $resultado[0]["pais_acessado"];
$pais_anterior = $resultado[1]["pais_acessado"];
$data = str_replace("-",'/',$data);

?>