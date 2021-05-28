<?php
require_once 'conexao.php';

$sql = "SELECT 
r.id,
a.nome AS atendente,
e.nome AS extranet,
r.num_solicitacao AS num_solicitacao,
r.data_teste AS data_teste,
r.link AS link,
e.nome_bd AS nome_db
FROM
relatorio_teste AS r
    JOIN
atendentes AS a ON a.id = r.id_atendente
    JOIN
extranet AS e ON e.id = r.id_extranet";
$resultset = mysqli_query($con, $sql) or 
ie("database error:". mysqli_error($con));
$data = array();
while( $rows = mysqli_fetch_assoc($resultset) ) {
	$data[] = $rows;
}
$results = array(
	"sEcho" => 1,
"iTotalRecords" => count($data),
"iTotalDisplayRecords" => count($data),
  "aaData"=>$data);
echo json_encode($results);
?>