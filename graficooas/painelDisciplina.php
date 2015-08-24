<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="dist/jquery.jqplot.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="dist/plugins/jqplot.pointLabels.js"></script>
<link rel="stylesheet" type="text/css" href="dist/jquery.jqplot.css" />
<?php
require_once("indicesoa.php");
require_once("disciplina.php");
require_once("acessosoa.php");
require_once("tempoacessooa.php");

/*$oa = array(5, 15, 20);
$idDisciplina = 10;
foreach($oa as $index => $idOA) {
	echo $index;
	echo $idOA;
	$indicesOA[$index] = new IndicesOA;
	$indicesOA[$index]->setIdOA($idOA);
	$indicesOA[$index]->setIdDisciplina($idDisciplina);
	$indicesOA[$index]->calculaIndiceRejeicao();
	$indicesRejeicao[$idOA] = $indicesOA[$index]->getIndiceRejeicao();
	echo "<br>";
}
arsort($indicesRejeicao);
var_dump($indicesRejeicao);*/
$disciplina = new Disciplina;
$disciplina->setIdDisciplina(44);
$indices = $disciplina->getIndices();
echo "<pre>";
var_dump($indices);
echo "</pre>";
?>

<script language="javascript">
$(document).ready(function(){
    var s1 = [<?php echo implode(", ", $indices["top_10"]); ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = [<?php foreach($indices["top_10"] as $index=>$top10) { $nomes[$index] = $index; } echo '"'.implode('", "', $nomes).'"'; ?>];
     
    var plot1 = $.jqplot('top10', [s1], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        animate: !$.jqplot.use_excanvas,
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {
            	fillToZero: true,
            	barWidth: 50
            },
            pointLabels: { show: true }
        },
        // Custom labels for the series are specified with the "label"
        // option on the series option.  Here a series option object
        // is specified for each series.
        series:[
            {label:'Acessos Validos'}
        ],
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        title:"Top 10 OA's mais acessados",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 4,
                tickOptions: {formatString: '%d'}
            }
        }
    });


	var s1 = [<?php echo implode(", ", $indices["indices_rejeicao"]); ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = [<?php foreach($indices["indices_rejeicao"] as $index=>$indicesRejeicao) { $nomes[$index] = $index; } echo '"'.implode('", "', $nomes).'"'; ?>];
     
    var plot1 = $.jqplot('indicesRejeicao', [s1], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        seriesColors: [ "#ff5800", "#EAA228", "#4bb2c5", "#c5b47f", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#0085cc"],
        animate: !$.jqplot.use_excanvas,
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {fillToZero: true},
            pointLabels: { show: true },
            rendererOptions: {
	            barWidth: 50,     // width of the bars.  null to calculate automatically.
	        }
        },
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        series:[
            {label: "Indice"}
        ],
        title:"Indices de Rejeicao",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 2,
                tickOptions: {formatString: '%.2f%'}
            }
        }
    });

	var s1 = [<?php echo implode(", ", $indices["indices_relevancia"]); ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = [<?php foreach($indices["indices_relevancia"] as $index=>$indicesRelevancia) { $nomes[$index] = $index; } echo '"'.implode('", "', $nomes).'"'; ?>];
     
    var plot1 = $.jqplot('indicesRelevancia', [s1], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        animate: !$.jqplot.use_excanvas,
        seriesColors: [ "#EAA228", "#4bb2c5", "#c5b47f", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            rendererOptions: {fillToZero: true},
            pointLabels: { show: true },
            rendererOptions: {
	            barWidth: 50,     // width of the bars.  null to calculate automatically.
	        }
        },
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        title:"Indices de Relevancia",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.5,
                tickOptions: {formatString: '%.2f'}
            }
        }
    });
});
</script>

<div id="top10" style="width: 600px; height: 250px; position: relative;" class="jqplot-target">
</div>

<div id="indicesRejeicao" style="width: 600px; height: 250px; position: relative;" class="jqplot-target">
</div>

<div id="indicesRelevancia" style="width: 600px; height: 250px; position: relative;" class="jqplot-target">
</div>