<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');

?>
<!-- IMPORTAÇÃO JQUERY-->
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">

    <style>

    body { font-size: 62.5%; }
    label, input { display:block; }
    input.text { margin-bottom:12px; width:95%; padding: .4em; }
    fieldset { padding:0; border:0; margin-top:25px; }
    h1 { font-size: 1.2em; margin: .6em 0; }
    div#users-contain { width: 350px; margin: 20px 0; }
    div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
    div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
    .ui-dialog .ui-state-error { padding: .3em; }
    .validateTips { border: 1px solid transparent; padding: 0.3em; }
    </style>
    <!-- FUNÇÃO QUE FAZ O SORTABLE E ENVIA OS ID'S DAS COMPETÊNCIAS-->
    <script>
    $(function() {
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            update: function(event, ui){
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                document.getElementById('arrayCompetencias').value = arrayCompetencias;
            }
        });
    });
</script>
</head>
<!-- <h2><?php echo ($_SESSION['user_name']); ?></h2> -->
<center> 
    <h2><?php echo (WORDING_CREATE_DISCIPLINA); ?></h2> 
</center>
    <form method="post" action="" name="registrar_nova_disciplina" id="registrar_nova_disciplina"> 
        <ul id="tabela1">
                    <?php
                    $idCompetencia = array();
                    $idCompetencia = explode(',',$_POST['arrayCompetencias']);
                    $comp = new Competencia();
                    $nomeCompetencia = $comp->getArrayOfNames();
                    print_r($_POST['arrayNomeCompetencias']);
                    $contador = count($idCompetencia);
                    for($i=0;$i<$contador;$i++){ ?>
                        <li id="<?php echo "".($idCompetencia[$i]); ?>" class="ui-state-default"><?php echo "".($nomeCompetencia[$i]); ?></li>
                    <?php } ?>
        </ul>


        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>

<center>
    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>
</center>


<?php include('_footer.php'); ?>