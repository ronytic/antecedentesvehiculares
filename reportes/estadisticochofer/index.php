<?php
include_once("../../login/check.php");






include_once("../../class/chofer.php");
$chofer=new chofer;
$v=$chofer->mostrarTodoRegistro("",1,"");
$totalchofer=count($v);
// echo $totalvehiculos;

$v=$chofer->mostrarTodoRegistro("CodChofer IN(SELECT CodChofer FROM antecedentechofer WHERE activo=1 and confirmado=1 GROUP BY CodChofer)",1,"");
$totalchofercon=count($v);
// echo $totalvehiculoscon;

// include_once("../../class/chofer.php");
// $chofer=new chofer;
// $ch=$chofer->mostrarTodoRegistro("",1,"Nombres");
// $ch=array_shift($ch);





$titulo="Estadística de Antecedentes de Choferes";
$folder="../../";



?>
<?php include_once($folder."cabecerahtml.php");?>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<?php include_once($folder."cabecera.php");?>
<div class="panel">
	<div class="panel-body">

    <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    <script type="text/javascript">
// Build the chart
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: '<?=$titulo;?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: false
            },
            showInLegend: true
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data: [{
            name: 'Con Antecedentes',
            y: <?=$totalchofercon;?>,
            sliced: true,
            selected: true
        }, {
            name: 'Sin Antecedentes',
            y: <?=$totalchofer-$totalchofercon;?>
        }]
    }]
});
</script>
	</div>
</div>


<?php include_once($folder."pie.php");?>
