<?php
require_once 'conexao.php';
require_once 'header.php';

?>

    <div class="card">
        <div class="card-header text-center bg-default">
            TESTE REALIZADOS
        </div>
        <div style="width: 95% !important; align-self: center;">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Atendente</th>
                        <th>Extranet</th>
                        <th>N° Solicitação</th>
                        <th>Data</th>
                        <th>Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<script>
j = jQuery.noConflict();
j( document ).ready(function() {
    var table = j('#example').dataTable({
			 "bProcessing": true,
			 "sAjaxSource": "server_side.php",
			  "bPaginate":true,
			  "sPaginationType":"full_numbers",
			  "iDisplayLength": 10,
              "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "loadingRecords": "Carregando...",
                    "sProcessing":    "Procesando...",
                    "oPaginate": {
                        "sFirst": "Início",
                        "sPrevious": "Anterior",
                        "sNext": "Próximo",
                        "sLast": "Último"
                    }
                },
			 "aoColumns": [
					{ mData: 'id' } ,
					{ mData: 'atendente' },
					{ mData: 'extranet' },
                    { 
                        "mRender": function(data, type, full) {
                            return '<a class="link_solicitacao" href="http://adm.franquiaextranet.com.br/default.php?p=20&q=1&id='+full['num_solicitacao']+'&extranet='+full['nome_db']+'" target="_blank">' + full['num_solicitacao'] + '</a>';
                        }
                     },
                    { mData: 'data_teste' },
                    {
                        "mData": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            return '<a class="btn btn-success" href=relatorio_teste_insert.php?id=' + full['id'] + '>' + '<span class="fa fa-eye" aria-hidden="true"></span>' + '</a><a class="btn btn-primary" href=' + full['link'] + ' target="_blank">' + '<span class="fa fa-link" aria-hidden="true"></span>' + '</a>';
                        }
                    }
			]
	});
});

</script>
<?php
require_once 'footer.php';
