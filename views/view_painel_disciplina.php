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

#usuarios {
    font-family: "Lato", "Helvetica Neue", "Helvetica", "Arial", "sans-serif";
    display: none;
    position: fixed;
    background-color: rgba(255, 255, 255, 1);
    border-radius: 5px;
    box-shadow: 0px 0px 2px 2px rgba(0, 0, 0, 0.4);
    width: 200px;
    height: 250px;
    left: 50%;
    margin-left: -100px;
    z-index: 9999;
}

#usuarios div:first-child {
    height: 15%;
    font-weight: 700;
    font-size: 20px;
    line-height: 35px;
    text-align: center;
    background: #108AC0;
    color: white;
}

#usuarios div:nth-child(2) {
    height: 75%;
    overflow-y: auto;
}

#usuarios div:last-child {
    height: 10%;
    line-height: 25px;
    text-align: center;
    background: #108AC0;
    color: white;
    cursor: pointer;
}

#usuarios table {
    width: 100%;
    border: 0;
    margin-bottom: 2px;
    border-spacing: 0;
}

#usuarios table td {
    width: 50%;
    padding-left: 5px;
    background: #cccccc url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
}

#usuarios table td:first-child {
    border-right: 1px solid #fff;
}

#usuarios table td:last-child {
    text-align: center;
}

#usuarios table:first-child td {
    width: 50%;
    text-align: center;
    font-size: 16px;
    font-weight: 700;
    padding-left: 5px;
    background: #bbb url("images/ui-bg_highlight-soft_75_cccccc_1x100.png") 50% 50% repeat-x;
}

#mais-estatisticas {
    font-family: "Lato", "Helvetica Neue", "Helvetica", "Arial", "sans-serif";
    text-align: center;
    display: none;
}
</style>
<script language="javascript">
<?php
    foreach ($indices['usuarios_acessos'] as $oa => $usuariosAcessos) {
        foreach ($usuariosAcessos as $usuario => $acessos) {
            $divUsuariosAcessos[$oa][$usuario].="<table><tr><td>".Usuario::getNome_byID($usuario)['user_name']."</td><td>".$acessos."</td></tr></table>";
        }
    }
    echo "divOA = [];\n";
    foreach ($divUsuariosAcessos as $oa => $usuario) {
        echo "divOA['".$oa."'] = '".implode($usuario)."';\n";
    }
?>
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
    function escondeUsuarios(){
        $("#usuarios").hide(500);
    }
<?php

    $indicesRejeicao = '';
    $nomesIndicesRejeicao = '';
    $indicesRelevancia = '';
    $nomesIndicesRelevancia = '';
    $chavesRejeicao = array_keys($indices['indices_rejeicao']);
    $chavesRelevancia = array_keys($indices['indices_relevancia']);
    $divUsuariosAcessos = '';

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
            {label:'Acessos V&aacute;lidos'}
        ],
        // Show the legend and put it outside the grid, but inside the
        // plot container, shrinking the grid to accomodate the legend.
        // A value of "outside" would not shrink the grid and allow
        // the legend to overflow the container.
        legend: {
            show: true,
            placement: 'outsideGrid'
        },
        title:"Top 10 OAs mais acessados",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
                tickOptions: {formatString: '%d'}
            }
        }
    });

    $('#top10').bind('jqplotDataClick', 
        function (ev, seriesIndex, pointIndex, data) {
            $("#usuarios").show(500);
            $('#usuarios').html("<div>"+ticks[pointIndex]+"</div><div><table><tr><td>Usuário</td><td>Acessos</td></tr></table>"+divOA[ticks[pointIndex]]+"</div><div onclick='escondeUsuarios()'>Sair</div>");
        }
    );


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
            {label: "Acessos V&aacute;lidos"},
            {label: "Acessos Inv&aacute;lidos"},
            {label: "Acessos Totais"}
        ],
        title:"Est&aacute;tisticas de Acessos",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
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
            {label: "&Iacute;ndice (%)"}
        ],
        title:"&Iacute;ndices de Rejeic&atilde;o",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
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
            {label: "&Iacute;ndice (unitario)"}
        ],
        title:"&Iacute;ndices de Relev&acirc;ncia",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
                tickOptions: {formatString: '%.2f'}
            }
        }
    });
    }
});

</script>
<div id="usuarios"></div>
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