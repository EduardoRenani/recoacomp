<?php
/**
 * Created by PhpStorm.
 * User: Delton Vaz
 * Date: 24/03/2015
 * Time: 17:50
 */
require_once('../../config/base.php');
$login = new Login();
$OA = new OA();
?>

<head>
    <!-- Importação do Jquery -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="../../css/base_cadastro_objeto.css">
    <link rel="stylesheet" href="../../css/tooltip.css">
    <link href="../../css/base_cadastro.css" rel="stylesheet">

    <!-- Custom CSS Login Page-->
    <!--link href="../../css/landing-page.css" rel="stylesheet"-->

    <link href="../../css/editar_OA_modal.css" rel="stylesheet"-->

    <!-- Custom Fonts -->
    <link href="../../font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <script type="text/javascript">
    $(document).ready(function(){
        console.log("funfou!");
        $("#nomeOA").keyup(function () { //user types username on inputfiled
            var url = $(this).val(); //get the string typed by user
            $.post('../../ajax/checkNomeOA.php', {'url':url}, function(data) { //make ajax call to check_username.php
            $("#status").html(data); //dump the data received from PHP page
        });
    });
    });


                function adicionaCompetenciaComAjax(idCompetencia, idDisciplina) {
                jQuery.ajax({
                    type: "GET",
                    url: "ajax/adiciona_competencia.php",
                    data: {
                        idCompetencia : idCompetencia,
                        idDisciplina : idDisciplina,
                    },
                    cache: false,
                    // importantinho.
                    error: function(e){
                        alert(e);
                    },
                    success: function(response){
                        console.log(response);
                        var n = noty({
                            text: 'Competência adicionada com sucesso',
                            layout: 'topCenter',
                            theme: 'relax', // or 'relax'
                            type: 'information',
                            killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
                            animation: {
                                open: {height: 'toggle'}, // jQuery animate function property object
                                close: {height: 'toggle'}, // jQuery animate function property object
                                easing: 'swing', // easing
                                speed: 500 // opening & closing animation speed
                            },
                            timeout: 500
                            // Desaparecer

                        });
                    }
                });
            }
    </script>

</head>

    <?php
      //  print_r($OA);
    ?>
    <div class="top-cadastrobase">
        <div class="text-left"><?php //echo (WORDING_REGISTER_NOVO_OA); ?></div>
    </div>
    <div class="cadastrobase-content">
    <form id="registrar_novo_OA" method="post" action="" name="registrar_novo_OA" class="form-horizontal" style="width: 100%;">
        <div class="control-group">
            <label class="control-label" for="nome"><?php echo WORDING_NAME; ?></label>
            <div class="controls">
                <input type="text" id="text" name="nomeOA" value="" class="required url"> <!-- Deixar type URL pq buga no banco de dados -->
                <div id="status"></div>
            </div>
        </div>
    </form>
    </div>

