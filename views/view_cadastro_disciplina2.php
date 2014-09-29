<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 29/09/14
 * Time: 10:48
 */
include('_header.php');
?>
<!-- IMPORTAÇÃO JQUERY-->
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        #sortable1, #sortable2 {
            border: 1px solid #eee;
            width: 142px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 10px;
        }
        #sortable1 li, #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 120px;
        }
    </style>
    <script>

        $(function() {
            $( "#sortable1, #sortable2" ).sortable({
                connectWith: ".connectedSortable"
            }).disableSelection();
        });
    </script>
</head>
<!-- FIM IMPORTAÇÃO JQUERY-->

<h2><?php echo ($_SESSION['user_name']); ?></h2>
<h2><?php echo (WORDING_CREATE_DISCIPLINA); ?></h2>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>

<ul id="sortable1" class="connectedSortable">
    <!--<li class="ui-state-highlight">Item Inicial</li>-->
    <?php
    $comp = new Competencia();
    $idCompetencia = $comp->getArrayOfIDs();
    $nomeCompetencia = $comp->getArrayOfNames();
    $contador = count($nomeCompetencia);

    for($i=0;$i<$contador;$i++){ ?>
        <li id="<?php echo "".($idCompetencia[$i]["idcompetencia"]); ?>" class="ui-state-default"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></li>
    <?php } ?>

</ul>
<ul id="sortable2" class="connectedSortable">
    <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
</ul>

<script>
    var sorted = $("#sortable2").sortable("toArray");
    function register(){
        $.ajax({
            method: "post",
            url: "getselectedcompetencias.php",
            data: {sorted:sorted}
        });
    }
</script>