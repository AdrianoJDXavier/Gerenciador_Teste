<?php
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors',1);
ini_set('max_execution_time', 500);
require_once 'relatorio_teste_functions.php';
for ($i = 800001; $i <= 1000000; $i++) {
    echo "teste";
    $sql = "INSERT INTO relatorio_teste2(id_atendente, id_extranet, id_tester, num_solicitacao, data_insercao, data_vencimento, data_teste, link, observacoes, tipo_teste) VALUES(9, 590, 94, $i, NOW(), NOW(), NOW(), 'https://www.youtube.com/watch?v=1w7OgIMMRc4', 'observacoes', '".utf8_encode('Teste')."')";
    db_query($sql);

}


?>