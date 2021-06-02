<?php
require_once 'relatorio_teste_functions.php';
session_start();
$sql = "SELECT 
        r.id,
        a.nome AS atendente,
        e.nome AS extranet,
        r.num_solicitacao AS num_solicitacao,
        DATE_FORMAT(r.data_teste, '%d/%m/%Y %H:%i') AS data_teste,
        r.tipo_teste AS tipo_teste,
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
  if(isset($_SESSION['filtro_teste_atendente']) && !empty($_SESSION['filtro_teste_atendente'])){
    $sql .= " AND r.id_atendente = ".$_SESSION['filtro_teste_atendente'];
  }
  if(isset($_SESSION['filtro_teste_tester']) && !empty($_SESSION['filtro_teste_tester'])){
    $sql .= " AND r.id_tester = ".$_SESSION['filtro_teste_tester'];
  }
  if(isset($_SESSION['filtro_teste_tipo_teste']) && !empty($_SESSION['filtro_teste_tipo_teste'])){
    $sql .= " AND r.tipo_teste = '".$_SESSION['filtro_teste_tipo_teste']."'";
  }
  if(isset($_SESSION['filtro_teste_inicio']) && !empty($_SESSION['filtro_teste_inicio'])){
    $sql .= " AND r.data_teste >= '".$_SESSION['filtro_teste_inicio']."'";
  }
  if(isset($_SESSION['filtro_teste_fim']) && !empty($_SESSION['filtro_teste_fim'])){
    $sql .= " AND r.data_teste <= '".$_SESSION['filtro_teste_fim']."'";
  }
  $sql .= " ORDER BY r.id DESC";
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