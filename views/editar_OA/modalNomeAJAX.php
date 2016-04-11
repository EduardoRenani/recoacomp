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

</head>

    <div class="top-cadastrobase">
        <div class="text-left"><?php //echo (WORDING_REGISTER_NOVO_OA); ?></div>
    </div>
    <div class="cadastrobase-content">
    <form id="registrar_novo_OA" method="post" action="" name="registrar_novo_OA" class="form-horizontal" style="width: 100%;">
        <div class="botao-edita" onclick="console.log(tipoEdicao);">Alterar Área de Conhecimento</div><br><br>
    </form>
    </div>

