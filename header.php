<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<script src="js/script.js"></script>
<link rel="stylesheet" href="css/style.css">

<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
require_once 'relatorio_teste_functions.php';
?>
<div class="container">
    <div class="btn-group">
        <button type="button" class="btn btn-primary" onclick="window.location = 'relatorio_teste_insert.php';">Inserir</button>
        <button type="button" class="btn btn-primary" onclick="window.location = 'relatorio_teste_list.php';">Listar</button>
    </div>