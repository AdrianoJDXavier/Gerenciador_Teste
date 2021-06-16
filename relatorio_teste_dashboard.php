<?php
require_once 'header.php';
require_once 'relatorio_teste_filtro.php';

$atendentesAtivos = getAtendentesMaisAtivos();
$extranetsAtivas =  getExtranetsMaisAtivos();
?>
<style>
    .chart{
      margin-top: 5px !important;
      margin-bottom: 5px !important;
  }
</style>
    <div class="card">
        <div class="card-header text-center bg-default">
            DASHBOARD
        </div>
        <div class="item_card">
            <div class="row chart">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="piechart" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart2" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row chart">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart3" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart2" style="width: 100%; height: 100%;"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

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

});


google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

      google.charts.setOnLoadCallback(drawVisualization);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Atendente', 'Solicitação'],
          <?php
          foreach($atendentesAtivos as $atendentes){
              echo "['".utf8_decode($atendentes['nome'])."', ".$atendentes['num_solicitacoes']."],";
          }
          ?>
        ]);

        var options = {
          title: 'Atendentes mais ativos',
          chartArea: {width: '100%', heigth: '100%'},
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }

      function drawBasic() {

var data = google.visualization.arrayToDataTable([
  ['Extranet', 'Nº solicitações',],
  <?php
    foreach($extranetsAtivas as $extranets){
        echo "['".utf8_decode($extranets['nome'])."', ".$extranets['num_solicitacoes']."],";
    }
    ?>
]);

var options = {
  title: 'Extranets mais ativas',
  chartArea: {width: '50%', heigth: '100%'},
  hAxis: {
    title: 'Total de solicitações',
    minValue: 0
  },
  vAxis: {
    title: 'Extranets'
  }
};

var chart = new google.visualization.BarChart(document.getElementById('chart2'));

chart.draw(data, options);
}

function drawVisualization() {
       
        var data = google.visualization.arrayToDataTable([
          ['Dia', 'Teste', 'Inspeção', 'Reteste', 'Reinspeção'],
          ['2004/05',  165,      938,         522,             998],
          ['2005/06',  135,      1120,        599,             1268],
          ['2006/07',  157,      1167,        587,             807],
          ['2007/08',  139,      1110,        615,             968],
          ['2008/09',  136,      691,         629,             1026]
        ]);

        var options = {
          title : 'Total de teste diario',
          vAxis: {title: 'Testes'},
          chartArea: {width: '50%', heigth: '100%'},
          hAxis: {title: 'Dia'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart3'));
        chart.draw(data, options);
      }


</script>
<?php
require_once 'footer.php';
