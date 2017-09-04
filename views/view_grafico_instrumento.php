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

<div id="usuarios"></div>
<a href="tabela_instrumento.php?idDisciplina=<?= $_GET['idDisciplina']; ?>">Ver tabelas</a>
<?php
    //echo "<pre>";
    //var_dump($indices['usuarios_acessos']);
    ?>
<?php
	$carregamento = new Carregamento();
	$competencia = new Competencia;
    $instrumento_oa = new Instrumento;
    $instrumentos = $disciplina->getInstrumentos($_GET['idDisciplina']);
    foreach ($instrumentos as $instrumento) {
    	foreach ($disciplina->listaAlunosMatriculados($_GET['idDisciplina']) as $aluno) {
    		$user_resposta = $instrumento_oa->getRespostaByInstrumentoAndUsuario($instrumento['id'], $aluno['usuario_idusuario']);
        	$resposta_nova = $instrumento_oa->decodeResposta($user_resposta['resposta1']);
        	$nao_possuo[0] = 0;
			$duvidas[0] = 0;
			$nocoes_basicas[0] = 0;
			$nao_tenho_certeza[0] = 0;
			$plena_certeza[0] = 0;
			$nao_possuo_habilidade[0] = 0;
			$duvidas_habilidade[0] = 0;
			$nocoes_basicas_habilidade[0] = 0;
			$nao_tenho_certeza_habilidade[0] = 0;
			$plena_certeza_habilidade[0] = 0;
			$nao_possuo_atitude[0] = 0;
			$duvidas_atitude[0] = 0;
			$nocoes_basicas_atitude[0] = 0;
			$nao_tenho_certeza_atitude[0] = 0;
			$plena_certeza_atitude[0] = 0;
        	switch($resposta_nova['conhecimento']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo[0]++;
                    break;
                case 1:
                    $duvidas[0]++;
                    break;
                case 2:
                    $nocoes_basicas[0]++;
                    break;
                case 3:
                    $nao_tenho_certeza[0]++;
                    break;
                case 4:
                    $plena_certeza[0]++;
                    break;
            }
            switch($resposta_nova['habilidade']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_habilidade[0]++;
                    break;
                case 1:
                    $duvidas_habilidade[0]++;
                    break;
                case 2:
                    $nocoes_basicas_habilidade[0]++;
                    break;
                case 3:
                    $nao_tenho_certeza_habilidade[0]++;
                    break;
                case 4:
                    $plena_certeza_habilidade[0]++;
                    break;
            }
            switch($resposta_nova['atitude']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_atitude[0]++;
                    break;
                case 1:
                    $duvidas_atitude[0]++;
                    break;
                case 2:
                    $nocoes_basicas_atitude[0]++;
                    break;
                case 3:
                    $nao_tenho_certeza_atitude[0]++;
                    break;
                case 4:
                    $plena_certeza_atitude[0]++;
                    break;
            }
            $resposta_nova = $instrumento_oa->decodeResposta($user_resposta['resposta2']);
        	$nao_possuo[1] = 0;
			$duvidas[1] = 0;
			$nocoes_basicas[1] = 0;
			$nao_tenho_certeza[1] = 0;
			$plena_certeza[1] = 0;
			$nao_possuo_habilidade[1] = 0;
			$duvidas_habilidade[1] = 0;
			$nocoes_basicas_habilidade[1] = 0;
			$nao_tenho_certeza_habilidade[1] = 0;
			$plena_certeza_habilidade[1] = 0;
			$nao_possuo_atitude[1] = 0;
			$duvidas_atitude[1] = 0;
			$nocoes_basicas_atitude[1] = 0;
			$nao_tenho_certeza_atitude[1] = 0;
			$plena_certeza_atitude[1] = 0;
        	switch($resposta_nova['conhecimento']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo[1]++;
                    break;
                case 1:
                    $duvidas[1]++;
                    break;
                case 2:
                    $nocoes_basicas[1]++;
                    break;
                case 3:
                    $nao_tenho_certeza[1]++;
                    break;
                case 4:
                    $plena_certeza[1]++;
                    break;
            }
            switch($resposta_nova['habilidade']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_habilidade[1]++;
                    break;
                case 1:
                    $duvidas_habilidade[1]++;
                    break;
                case 2:
                    $nocoes_basicas_habilidade[1]++;
                    break;
                case 3:
                    $nao_tenho_certeza_habilidade[1]++;
                    break;
                case 4:
                    $plena_certeza_habilidade[1]++;
                    break;
            }
            switch($resposta_nova['atitude']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_atitude[1]++;
                    break;
                case 1:
                    $duvidas_atitude[1]++;
                    break;
                case 2:
                    $nocoes_basicas_atitude[1]++;
                    break;
                case 3:
                    $nao_tenho_certeza_atitude[1]++;
                    break;
                case 4:
                    $plena_certeza_atitude[1]++;
                    break;
            }
            $resposta_nova = $instrumento_oa->decodeResposta($user_resposta['resposta3']);
        	$nao_possuo[2] = 0;
			$duvidas[2] = 0;
			$nocoes_basicas[2] = 0;
			$nao_tenho_certeza[2] = 0;
			$plena_certeza[2] = 0;
			$nao_possuo_habilidade[2] = 0;
			$duvidas_habilidade[2] = 0;
			$nocoes_basicas_habilidade[2] = 0;
			$nao_tenho_certeza_habilidade[2] = 0;
			$plena_certeza_habilidade[2] = 0;
			$nao_possuo_atitude[2] = 0;
			$duvidas_atitude[2] = 0;
			$nocoes_basicas_atitude[2] = 0;
			$nao_tenho_certeza_atitude[2] = 0;
			$plena_certeza_atitude[2] = 0;
        	switch($resposta_nova['conhecimento']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo[2]++;
                    break;
                case 1:
                    $duvidas[2]++;
                    break;
                case 2:
                    $nocoes_basicas[2]++;
                    break;
                case 3:
                    $nao_tenho_certeza[2]++;
                    break;
                case 4:
                    $plena_certeza[2]++;
                    break;
            }
            switch($resposta_nova['habilidade']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_habilidade[2]++;
                    break;
                case 1:
                    $duvidas_habilidade[2]++;
                    break;
                case 2:
                    $nocoes_basicas_habilidade[2]++;
                    break;
                case 3:
                    $nao_tenho_certeza_habilidade[2]++;
                    break;
                case 4:
                    $plena_certeza_habilidade[2]++;
                    break;
            }
            switch($resposta_nova['atitude']) {
                case NULL:
                    break;
                case 0:
                    $nao_possuo_atitude[2]++;
                    break;
                case 1:
                    $duvidas_atitude[2]++;
                    break;
                case 2:
                    $nocoes_basicas_atitude[2]++;
                    break;
                case 3:
                    $nao_tenho_certeza_atitude[2]++;
                    break;
                case 4:
                    $plena_certeza_atitude[2]++;
                    break;
            }
    	}
?>
<h1><?=$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome'];?></h1>
<div id="graficos" style="width: 100%; text-align: center;">
    <div id="conhecimento<?=$instrumento['idcompetencia']?>" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>
    <div id="habilidade<?=$instrumento['idcompetencia']?>" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>
    <div id="atitude<?=$instrumento['idcompetencia']?>" style="margin: 0 auto; width: 800px; margin-bottom: 20px;" class="jqplot-target">
    </div>
</div>
<script language="javascript">
$(document).ready(function(){
    var s1 = [<?= $nao_possuo[0]; ?>,<?= $nao_possuo[1]; ?>,<?= $nao_possuo[2]; ?>];
    var s2 = [<?= $duvidas[0]; ?>,<?= $duvidas[1]; ?>,<?= $duvidas[2]; ?>];
    var s3 = [<?= $nocoes_basicas[0]; ?>,<?= $nocoes_basicas[1]; ?>,<?= $nocoes_basicas[2]; ?>];
    var s4 = [<?= $nao_tenho_certeza[0]; ?>,<?= $nao_tenho_certeza[1]; ?>,<?= $nao_tenho_certeza[2]; ?>];
    var s5 = [<?= $plena_certeza[0]; ?>,<?= $plena_certeza[1]; ?>,<?= $plena_certeza[2]; ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks1 = [<?='"'.$instrumento['problema_um'].'"';?>,<?='"'.$instrumento['problema_dois'].'"';?>,<?='"'.$instrumento['problema_tres'].'"';?>];
     
    var plot1 = $.jqplot('conhecimento<?=$instrumento['idcompetencia']?>', [s1, s2, s3, s4, s5], {
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
            {label: "Não possui"},
            {label: "Dúvidas"},
            {label: "Noções básicas"},
            {label: "Não tem certeza"},
            {label: "Plena certeza"}
        ],
        title:"Conhecimento",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks1
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
                tickOptions: {formatString: '%d'}
            }
        }
    });

    var s1 = [<?= $nao_possuo_habilidade[0]; ?>,<?= $nao_possuo_habilidade[1]; ?>,<?= $nao_possuo_habilidade[2]; ?>];
    var s2 = [<?= $duvidas_habilidade[0]; ?>,<?= $duvidas_habilidade[1]; ?>,<?= $duvidas_habilidade[2]; ?>];
    var s3 = [<?= $nocoes_basicas_habilidade[0]; ?>,<?= $nocoes_basicas_habilidade[1]; ?>,<?= $nocoes_basicas_habilidade[2]; ?>];
    var s4 = [<?= $nao_tenho_certeza_habilidade[0]; ?>,<?= $nao_tenho_certeza_habilidade[1]; ?>,<?= $nao_tenho_certeza_habilidade[2]; ?>];
    var s5 = [<?= $plena_certeza_habilidade[0]; ?>,<?= $plena_certeza_habilidade[1]; ?>,<?= $plena_certeza_habilidade[2]; ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks1 = [<?='"'.$instrumento['problema_um'].'"';?>,<?='"'.$instrumento['problema_dois'].'"';?>,<?='"'.$instrumento['problema_tres'].'"';?>];
     
    var plot1 = $.jqplot('habilidade<?=$instrumento['idcompetencia']?>', [s1, s2, s3, s4, s5], {
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
            {label: "Não possui"},
            {label: "Dúvidas"},
            {label: "Noções básicas"},
            {label: "Não tem certeza"},
            {label: "Plena certeza"}
        ],
        title:"Habilidade",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks1
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
                tickOptions: {formatString: '%d'}
            }
        }
    });

    
    var s1 = [<?= $nao_possuo_atitude[0]; ?>,<?= $nao_possuo_atitude[1]; ?>,<?= $nao_possuo_atitude[2]; ?>];
    var s2 = [<?= $duvidas_atitude[0]; ?>,<?= $duvidas_atitude[1]; ?>,<?= $duvidas_atitude[2]; ?>];
    var s3 = [<?= $nocoes_basicas_atitude[0]; ?>,<?= $nocoes_basicas_atitude[1]; ?>,<?= $nocoes_basicas_atitude[2]; ?>];
    var s4 = [<?= $nao_tenho_certeza_atitude[0]; ?>,<?= $nao_tenho_certeza_atitude[1]; ?>,<?= $nao_tenho_certeza_atitude[2]; ?>];
    var s5 = [<?= $plena_certeza_atitude[0]; ?>,<?= $plena_certeza_atitude[1]; ?>,<?= $plena_certeza_atitude[2]; ?>];
    // Can specify a custom tick Array.
    // Ticks should match up one for each y value (category) in the series.
    var ticks1 = [<?='"'.$instrumento['problema_um'].'"';?>,<?='"'.$instrumento['problema_dois'].'"';?>,<?='"'.$instrumento['problema_tres'].'"';?>];
     
    var plot1 = $.jqplot('atitude<?=$instrumento['idcompetencia']?>', [s1, s2, s3, s4, s5], {
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
            {label: "Não possui"},
            {label: "Dúvidas"},
            {label: "Noções básicas"},
            {label: "Não tem certeza"},
            {label: "Plena certeza"}
        ],
        title:"Atitude",
        axes: {
            // Use a category axis on the x axis and use our custom ticks.
            xaxis: {
                renderer: $.jqplot.CategoryAxisRenderer,
                ticks: ticks1
            },
            // Pad the y axis just a little so bars can get close to, but
            // not touch, the grid boundaries.  1.2 is the default padding.
            yaxis: {
                pad: 1.2,
                tickOptions: {formatString: '%d'}
            }
        }
    });
});
</script>
<?php
    }
?>

<script language="javascript">
</script>
<!-- Don't touch this! -->


    <script class="include" type="text/javascript" src="js/jplot/jquery.jqplot.js"></script>
<!-- Additional plugins go here -->

  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.barRenderer.js"></script>
  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.pieRenderer.js"></script>
  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.categoryAxisRenderer.js"></script>
  <script class="include" type="text/javascript" src="js/jplot/plugins/jqplot.pointLabels.js"></script>

<!-- End additional plugins -->