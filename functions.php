<?php
require_once 'conexao.php';

function db_query($sql){
    global $con;
    return $con->query($sql);
}

function db_fetch_array($rs){
    return $rs->fetch_assoc();
}

function getAtendentes(){
    $sql = "SELECT 
                id,nome
            FROM
                atendentes
            WHERE
                ativo = 'S'";
    $result = db_query($sql);
    if(!empty($result)){
        $return_array = array();
        while( $row = db_fetch_array($result)){
            $return_array[] = $row;
        }
        return $return_array;
    }
    return NULL;
}
?>