<?php
    include('conexao.php');

    $select = $conexao->prepare("SELECT * FROM acessos WHERE pais_acessado IS NOT NULL ORDER BY id_acesso DESC LIMIT 2");
    $select->execute();
    $resultado = $select->fetchAll(PDO::FETCH_ASSOC);
    $data = date("d-m-Y",strtotime($resultado[0]["data_acesso"]));
    
    $pais = str_replace("+"," ",$resultado[0]["pais_acessado"]);
    
    function footer(){
        
        echo "Data do último acesso à API: ".$GLOBALS["data"]." | Último país consultado: ".$GLOBALS["pais"];
        
    }
    
    $data = str_replace("-",'/',$data);

?>
