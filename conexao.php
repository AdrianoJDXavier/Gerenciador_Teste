<?php
$hostname = "localhost";
$bancodedados = "relatorio_teste";
$usuario = "root";
$senha = "";

$con = new mysqli($hostname, $usuario, $senha, $bancodedados);
if ($con->connect_errno) {
    echo "Falha ao conectar: (" . $con->connect_errno . ") " . $con->connect_error;
}


?>