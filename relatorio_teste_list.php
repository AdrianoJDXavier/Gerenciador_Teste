<?php
require_once 'header.php';
require_once 'relatorio_teste_filtro.php';
?>
    <div class="card">
        <div class="card-header text-center bg-default">
            TESTE REALIZADOS
        </div>
        <div class="item_card table-responsive">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Atendente</th>
                        <th>Extranet</th>
                        <th>N° Solicitação</th>
                        <th>Data</th>
                        <th>Tipo</th>
                        <th class="td-acao">Ação</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
<div id="getModal"></div>
<script>
j = jQuery.noConflict();

j( document ).ready(function() {
    j("#filtros").hide();
    j("#ocultar").hide();
    j("#exibir").click(function () {
        j("#filtros").show(1000);
        j("#ocultar").show(1000);
        j("#exibir").hide(1000);
    });

    j("#ocultar").click(function () {
        j("#filtros").hide(1000);
        j("#ocultar").hide(1000);
        j("#exibir").show(1000);
    });

    var table = j('#example').dataTable({
        "bProcessing": true,
         "serverSide": true,
         "order": [[ 0, "desc" ]],
         "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
                    "loadingRecords": "Carregando...",
                    "sProcessing":    "Processando...",
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
                    { mData: 'tipo_teste'},
                    {
                        "mData": null,
                        "bSortable": false,
                        "mRender": function(data, type, full) {
                            if(full['link'] != ''){
                            return '<button class="btn btn-success" data-itemid="' + full['id'] + '" onclick="OpenModalFor(this)">' + '<span class="fa fa-eye" aria-hidden="true"></span>' + '</button>'+
                            '<a class="btn btn-primary" href=' + full['link'] + ' target="_blank">' + '<span class="fa fa-link" aria-hidden="true"></span>' + '</a>';
                            }else{
                                return '<button class="btn btn-success" data-itemid="' + full['id'] + '" onclick="OpenModalFor(this)">' + '<span class="fa fa-eye" aria-hidden="true"></span>' + '</button>';
                            }
                        }
                    }
			],
         "ajax":{
            url :'server_side.php', 
            type: "post",  
            error: function(data){
                
            }
          }
	});
});


</script>
<?php
require_once 'footer.php';
