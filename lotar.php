<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
ini_set('max_execution_time', 500);
require_once 'relatorio_teste_functions.php';
for ($i = 10001; $i <= 200000; $i++) {
    echo "teste";
    $sql = "INSERT INTO relatorio_teste(id_atendente, id_extranet, id_tester, data_insercao, data_vencimento, data_teste, link, observacoes, tipo_teste) VALUES(94, 297, 94, NOW(), NOW(), NOW(), 'link', 'observacoes', 'tipo_teste')";
    db_query($sql);

}


?>