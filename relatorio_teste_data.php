<?php
require_once 'relatorio_teste_functions.php';
if(isset($_POST['Enviar']) && $_POST['Enviar'] == 'enviar'){
    isset($_POST['atendente']) ? $atendente = $_POST['atendente'] : $atendente = '';
    isset($_POST['extranet']) ? $extranet = $_POST['extranet'] : $extranet = '';
    isset($_POST['tester']) ? $tester = $_POST['tester'] : $tester = '';
    isset($_POST['num_solicitacao']) ? $num_solicitacao = $_POST['num_solicitacao'] : $num_solicitacao = '';
    isset($_POST['insercao']) ? $insercao = $_POST['insercao'] : $insercao = '';
    isset($_POST['vencimento']) ? $vencimento = $_POST['vencimento'] : $vencimento = '';
    isset($_POST['tipo_teste']) ? $tipo_teste = $_POST['tipo_teste'] : $tipo_teste = '';
    isset($_POST['link']) ? $link = $_POST['link'] : $link = '';
    isset($_POST['observacao']) ? $observacao = $_POST['observacao'] : $observacao = '';
    
    insertTeste($atendente, $extranet, $tester, $num_solicitacao, $insercao, $vencimento, $link, $observacao, $tipo_teste);

    echo"<script>window.location.href = 'relatorio_teste_list.php';</script>";
}
?>