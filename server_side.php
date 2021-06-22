<?php
session_start();
include_once('relatorio_teste_functions.php'); 

$filtro = getFiltros();
$where="";
if( !empty($_REQUEST['search']['value']) ) { 
    $search = $_REQUEST['search']['value'];
	$where.=" AND ( a.nome LIKE '%".$search."%' ";    
	$where.=" OR e.nome LIKE '%".$search."%' ";
    $where.=" OR r.id LIKE '%".$search."%' ";
    $where.=" OR r.num_solicitacao LIKE '%".$search."%' ";
    $where.=" OR r.tipo_teste LIKE '%".$search."%' )";
}
$totalRecordsSql = "SELECT count(*) as total FROM relatorio_teste $where;";
$resultset = db_query($totalRecordsSql);
$res = array();
while( $rows = db_fetch_array($resultset) ) {
	$res[] = $rows;
}
$totalRecords=0;
foreach ($res as $key => $value) {
	$totalRecords = $value['total'];
}
$columns = array( 
	0 =>'id', 
	1 => 'atendente',
	2=> 'extranet',
    3=>'num_solicitacao',
    4=>'data',
    5=>'tipo_teste',
);

$sql = "SELECT 
        r.id,
        a.nome AS atendente,
        e.nome AS extranet,
        r.num_solicitacao AS num_solicitacao,
        DATE_FORMAT(r.data_teste, '%d/%m/%Y %H:%i') AS data_teste,
        r.data_teste as data,
        r.tipo_teste AS tipo_teste,
        r.link AS link,
        e.nome_bd AS nome_db
        FROM
        relatorio_teste AS r
            JOIN
        atendentes AS a ON a.id = r.id_atendente
            JOIN
        extranet AS e ON e.id = r.id_extranet
        WHERE 1 = 1
            $where $filtro";

$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";

$resultset = db_query($sql);
$data = array();
while( $rows = db_fetch_array($resultset) ) {
	$data[] = $rows;
}
$json_data = array(
 "draw"            => intval( $_REQUEST['draw'] ),   
 "recordsTotal"    => intval($totalRecords ),  
 "recordsFiltered" => intval($totalRecords),
 "data"            => $data,
 "sql" => $sql
 );

echo json_encode($json_data);
?>