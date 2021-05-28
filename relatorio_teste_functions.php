<?php
require_once 'conexao.php';

function db_query($sql){
    global $con;
    return $con->query($sql);
}

function db_fetch_array($rs){
    return $rs->fetch_array();
}

function getAtendentes(){
    $sql = "SELECT 
                id,nome
            FROM
                atendentes
            WHERE
                ativo = 'S' ORDER BY nome";
    $result = db_query($sql);
    if(!empty($result)){
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function getExtranets(){
    $sql = "SELECT 
                id, nome
            FROM
                extranet
            ORDER BY nome";
    $result = db_query($sql);
    if(!empty($result)){
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}

function insertTeste($id_atendente, $id_extranet, $id_tester, $num_solicitacao, $data_insercao, $data_vencimento, $link, $observacoes, $tipo_teste){
    $sql = "INSERT INTO relatorio_teste(id_atendente, id_extranet, id_tester, num_solicitacao, data_insercao, data_vencimento, data_teste, link, observacoes, tipo_teste) VALUES($id_atendente, $id_extranet, $id_tester, $num_solicitacao, '$data_insercao', '$data_vencimento', NOW(), '$link', '$observacoes', '$tipo_teste')";
    db_query($sql);
}
?>