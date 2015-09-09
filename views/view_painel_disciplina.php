<style>
#table-estatisticas {
    display: inline-block;
    margin-bottom: 50px;
}

#table-estatisticas td {
    text-align: center;
    vertical-align: middle;
    padding-left: 10px;
    padding-right: 10px;
}

#table-estatisticas tr {
    background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
}

#table-estatisticas tr:first-child {
    font-weight: 700;
    background: #108AC0;
    color: white;
}



#mais-estatisticas {
    font-family: "Lato", "Helvetica Neue", "Helvetica", "Arial", "sans-serif";
    text-align: center;
    display: none;
}
</style>
<script language="javascript">
$(function () {
    $("#ver-mais").click(function(){
        $("#graficos").toggle(500);
        $("#mais-estatisticas").toggle(500);
    });
    $("#fechar").click(function(){
        $("#mais-estatisticas").toggle(500);
        $("#graficos").toggle(500);
    });
});
<?php
    $indicesRejeicao = '';
    $nomesIndicesRejeicao = '';
    $indicesRelevancia = '';
    $nomesIndicesRelevancia = '';
    $chavesRejeicao = array_keys($indices['indices_rejeicao']);
    $chavesRelevancia = array_keys($indices['indices_relevancia']);
    foreach($indices['indices_rejeicao'] as $index=>$indice) {
        if($indice != -1) {
            if ($index == end($chavesRejeicao)) { 
                $indicesRejeicao.=$indice; 
                $nomesIndicesRejeicao.='"'.$index.'"';
            }
            else {
                $indicesRejeicao.=$indice.", ";
                $nomesIndicesRejeicao.='"'.$index.'", ';
            }
        }
    }
    foreach($indices['indices_relevancia'] as $index=>$indice) {
        if($indice != -1) {
            if ($index == end($chavesRelevancia)) { 
                $indicesRelevancia.=$indice; 
                $nomesIndicesRelevancia.='"'.$index.'"';
            }
            else {
                $indicesRelevancia.=$indice.", ";
                $nomesIndicesRelevancia.='"'.$index.'", ';
            }
        }
    }
?>
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
            pointLabels: { show: true },
            rendererOptions: {
                fillToZero: true,
                barWidth: 50
            }
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


    var s1 = [<?php echo implode(", ", $indices["acessos_validos"]); ?>];
    var s2 = [<?php echo implode(", ", $indices["acessos_invalidos"]); ?>];
    var s3 = [<?php echo implode(", ", $indices["acessos_totais"]); ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = [<?php foreach($indices["acessos_validos"] as $index3=>$acessosTotais) { $nomes3[$index3] = $index3; } echo '"'.implode('", "', $nomes3).'"'; ?>];
     
    var plot1 = $.jqplot('acessos', [s1, s2, s3], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        animate: !$.jqplot.use_excanvas,
        seriesColors: [ "#ff5800", "#EAA228", "#4b5de4", "#4bb2c5", "#c5b47f", "#579575", "#839557", "#958c12",
        "#953579", "#d8b83f", "#0085cc"],
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            pointLabels: { show: true },
            rendererOptions: {fillToZero: true},
            rendererOptions: {
                barWidth: 10,     // width of the bars.  null to calculate automatically.
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
            {label: "Acessos Validos"},
            {label: "Acessos Invalidos"},
            {label: "Acessos Totais"}
        ],
        title:"Estatisticas de Acessos",
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
                tickOptions: {formatString: '%d'}
            }
        }
    });


    var s1 = [<?php echo $indicesRejeicao; ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = [<?php echo $nomesIndicesRejeicao; ?>];
     
    if(ticks.length != 0) {
        var plot1 = $.jqplot('indicesRejeicao', [s1], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        seriesColors: [ "#ff5800", "#EAA228", "#4bb2c5", "#c5b47f", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#0085cc"],
        animate: !$.jqplot.use_excanvas,
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            pointLabels: { show: true },
            rendererOptions: {fillToZero: true},
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
            {label: "Indice (%)"}
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
    }

    var s1 = [<?php echo $indicesRelevancia; ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks = [<?php echo $nomesIndicesRelevancia; ?>];
     
    if(ticks.length != 0) {
        var plot1 = $.jqplot('indicesRelevancia', [s1], {
        // The "seriesDefaults" option is an options object that will
        // be applied to all series in the chart.
        animate: !$.jqplot.use_excanvas,
        seriesColors: [ "#EAA228", "#4bb2c5", "#c5b47f", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
        seriesDefaults:{
            renderer:$.jqplot.BarRenderer,
            pointLabels: { show: true },
            rendererOptions: {fillToZero: true},
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
            {label: "Indice (unitario)"}
        ],
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
    }
});
</script>
<div id="graficos" style="width: 100%; text-align: center;">
    <div id="top10" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>

    <div id="acessos" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>

    <div id="indicesRejeicao" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>

    <div id="indicesRelevancia" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>
    <div id="ver-mais">
    <a href="#">Ver Mais</a>
    </div>
</div>
<div id="mais-estatisticas">
    <?php
        echo "<div style='float: left; text-align: center; width: 50%;'><h2>Indices de Relevância</h2>";
        echo "<table id='table-estatisticas'>";
        echo "<tr>
                <td>
                    Nome do OA
                </td>
                <td>
                    Índice
                </td>
            </tr>";
        foreach ($indices['indices_relevancia'] as $key => $indice) {
            echo "<tr>";
            if($indice != -1) {
                echo "<td>".$key."</td><td>".number_format($indice, 2, '.', '')."</td>";
            }
            else {
                echo "<td>".$key."</td><td>"."Não há informações"."</td>";
            }
            echo "</tr>";
        }
        echo "</table></div>";
        echo "<div style='float: right; text-align: center; width: 50%;'><h2>Indices de Rejeição</h2>";
        echo "<table id='table-estatisticas'>";
        echo "<tr>
                <td>
                    Nome do OA
                </td>
                <td>
                    Índice
                </td>
            </tr>";
        foreach ($indices['indices_rejeicao'] as $key => $indice) {
            echo "<tr>";
            if($indice != -1) {
                echo "<td>".$key."</td><td>".number_format($indice, 2, '.', '')."</td>";
            }
            else {
                echo "<td>".$key."</td><td>"."Não há informações"."</td>";
            }
            echo "</tr>";
        }
        echo "</table></div>";
        echo "<h2>Estatísticas de acessos</h2>";
        echo "<table id='table-estatisticas'>";
        echo "<tr>
                <td>
                    Nome do OA
                </td>
                <td>
                    Acessos válidos
                </td>
                <td>
                    Acessos inválidos
                </td>
                <td>
                    Acessos totais
                </td>
            </tr>";
        foreach ($indices['acessos_totais'] as $key => $indice) {
            echo "<tr>";
                echo "<td>".$key."</td>
                <td>".$indices['acessos_validos'][$key]."</td>
                <td>".$indices['acessos_invalidos'][$key]."</td>
                <td>".$indices['acessos_totais'][$key]."</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<div id='fechar'><a href='#'>Fechar</a></div>"
    ?>
</div>