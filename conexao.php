<?php
$usuario = "root";
$senha = "";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Definindo opção "Errmode_exception" no atributo "attr_errmode" para o código lançar uma exceção se ocorrer algum erro;
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //Definindo o modo padrão de retorno de consultas SQL como array associativo de chaves e valores.
);
try{
    $conexao = new PDO("mysql:host=localhost;dbname=Kidopi",$usuario,$senha,$options);
} catch (PDOException $e){
    echo "Erro na conexão com o banco de dados!!".$e->getMessage();
}
?>