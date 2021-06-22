<?php
require_once 'header.php';
require_once 'relatorio_teste_filtro.php';

$atendentesAtivos = getAtendentesMaisAtivos();
$extranetsAtivas =  getExtranetsMaisAtivos();
$atendentesAtrasados = getAtendentesAtradados();
$extranetsMaiorReteste = getExtranetsMaiorReteste();
$testeDia = getTestesDiario();

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
                            <div id="piechart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row chart">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart33"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div id="chartReteste"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row chart">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart3"></div>
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
google.charts.setOnLoadCallback(drawStuff);
google.charts.setOnLoadCallback(maiorReteste);

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
          <?php
            foreach($testeDia as $testedia){
                echo "['".$testedia['Dia']."', ".$testedia['teste'].", ".$testedia['inspecao'].", ".$testedia['reteste'].", ".$testedia['reinspecao']."],";
            }
        ?>
        ]);

        var options = {
          title : 'Total de teste diario',
          vAxis: {title: 'Testes'},
          chartArea: {width: '70%', heigth: '100%'},
          hAxis: {title: 'Dia'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        
        var chart = new google.visualization.ComboChart(document.getElementById('chart3'));
        chart.draw(data, options);
      }


      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Atendente', 'N° Solicitações'],
          <?php
          foreach($atendentesAtrasados as $atendentes){
              echo "['".utf8_decode($atendentes['nome'])."', ".$atendentes['num_solicitacoes']."],";
          }
          ?>
        ]);

        var options = {
        chartArea: {width: '50%', heigth: '100%'},
          legend: { position: 'none' },
          chart: {
            title: 'Atendentes com solicitações atrasadas',
            subtitle: 'Entregues para teste no dia ou vencidas' },
          bar: { groupWidth: "80%" }
        };

        var chart = new google.charts.Bar(document.getElementById('chart33'));
        // Convert the Classic options to Material options.
        chart.draw(data, google.charts.Bar.convertOptions(options));
      }



      function maiorReteste() {
        var data = google.visualization.arrayToDataTable([
          ['Extranet', 'Solicitação'],
          <?php
          foreach($extranetsMaiorReteste as $maiorReteste){
              echo "['".utf8_decode($maiorReteste['nome'])."', ".$maiorReteste['num_solicitacoes']."],";
          }
          ?>
        ]);

        var options = {
          title: 'Solicitações de maior reteste',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartReteste'));
        chart.draw(data, options);
      }
</script>
<?php
require_once 'footer.php';
