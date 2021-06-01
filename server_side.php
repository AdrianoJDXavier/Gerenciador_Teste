<?php
require_once 'relatorio_teste_functions.php';
session_start();
$sql = "SELECT 
r.id,
a.nome AS atendente,
e.nome AS extranet,
r.num_solicitacao AS num_solicitacao,
DATE_FORMAT(r.data_teste, '%d/%m/%Y %H:%i') AS data_teste,
r.link AS link,
e.nome_bd AS nome_db
FROM
relatorio_teste AS r
    JOIN
atendentes AS a ON a.id = r.id_atendente
    JOIN
extranet AS e ON e.id = r.id_extranet
    WHERE 1 = 1 ";

  if(isset($_SESSION['filtro_teste_extranet']) && !empty($_SESSION['filtro_teste_extranet'])){
    $sql .= " AND r.id_extranet = ".$_SESSION['filtro_teste_extranet'];
  }
  
$resultset = db_query($sql);
$data = array();
while( $rows = db_fetch_array($resultset) ) {
	$data[] = $rows;
}
$results = array(
  "sEcho" => 1,
  "iTotalRecords" => count($data),
  "iTotalDisplayRecords" => count($data),
  "aaData"=>$data
);

echo json_encode($results);
?>