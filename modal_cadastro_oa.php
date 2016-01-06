<?php
/**
 * Created by PhpStorm.
 * User: Delton Vaz
 * Date: 24/03/2015
 * Time: 17:50
 */ 

if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once('libraries/password_compatibility_library.php');
}
require_once('base.php');

$login = new Login();
$OA = new OA();

//include('_header.php');

?>

<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo"<script type='text/javascript'>";

            echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo"<script type='text/javascript'>";

            echo "alert('".$message."');";

            echo "</script>";
        }
    }
}?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo"<script type='text/javascript'>";

            echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo"<script type='text/javascript'>";

            echo "alert('".$message."');";

            echo "</script>";
        }
    }
}
?>

<?php
// mostra erros do cadastro de disciplinas
if (isset($disciplina)) {
    if ($disciplina->errors) {
        foreach ($disciplina->errors as $error) {
            echo"<script type='text/javascript'>";

                echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($disciplina->messages) {
        foreach ($disciplina->messages as $message) {
            echo"<script type='text/javascript'>";

                echo "alert('".$message."');";

            echo "</script>";
        }
    }
}
?>

<?php
// mostra erros do cadastro de competencias
if (isset($competencia)) {
    if ($competencia->errors) {
        foreach ($competencia->errors as $error) {
                        echo"<script type='text/javascript'>";

                echo "decisao = alert('".$error."');";

            echo "</script>";
        }
    }
    if ($competencia->messages) {
        foreach ($competencia->messages as $message) {
                        echo"<script type='text/javascript'>";

                echo "confirm('".$message."'); window.close();";

            echo "</script>";
        }
    }
}
?>

<?php
// mostra erros do cadastro de OAS
if (isset($OA)) {
    if ($OA->errors) {
        foreach ($OA->errors as $error) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($OA->messages) {
        foreach ($OA->messages as $message) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$message."');";
                $host  = $_SERVER['HTTP_HOST'];
                $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
                $extra = 'index.php';
                echo "<script language='JavaScript'> setTimeout(function () {window.location='http://".$host.$uri."/".$extra."';}, 100); </script> ";

            echo "</script>";
        }
    }
}
?>
<!-- ARRUMAR AS VALIDAÇÕES -->

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Recoacomp</title>


    <!-- Importação do Jquery -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/growl.js"></script>
    <script src="jquery.bootstrap.wizard.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="js/bootstrap-tagsinput-angular.js"></script>
    <script src="js/bootstrap-tagsinput.js"></script>
    <!-- Picklist cadastro de disciplinas -->
    <script src="js/picklist.js"></script>
    <script src="js/primeui-1.0.js"></script>
    

    <script src="js/jquery.range.js"></script>
    <link href="css/jquery.range.css" rel="stylesheet">
    <link rel="stylesheet" href="css/base_cadastro_objeto.css">
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/base_cadastro.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="prettify.css" rel="stylesheet">

    <!-- Loader do cadastro de OA CSS -->
    <link href="css/cadastro_OA.css" rel="stylesheet">
    <link href="css/progress_cadastro_OA.css" rel="stylesheet">
    <link href="css/progress_cadastro_modal_oa.css" rel="stylesheet">
    <!-- Growl das mensagens de cadastros -->
    <link href="css/growl.css" rel="stylesheet">
    <!-- Seletor das palavras-chaves -->
    <link href="css/bootstrap-tagsinput.css" rel="stylesheet">
    <!-- Picklist cadastro de disciplinas -->
    <link href="css/picklist.css" rel="stylesheet">
    <link href="css/primeui-1.0.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">

    <!-- Custom CSS Login Page-->
    <link href="css/landing-page.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/landing-page-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/landing-page-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/landing-page-large.css' />

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">


    <script src="js/jquery.range.js"></script>
    <link href="css/jquery.range.css" rel="stylesheet">
    <link rel="stylesheet" href="css/base_cadastro_objeto.css">
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/base_cadastro.css" rel="stylesheet">


        <script src="js/jquery-customselect.js"></script>

        <link href="css/jquery-customselect.css" rel="stylesheet" />
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

<!-- Script de configuração -->


    <!-- clean separation of HTML and PHP -->
    <script>
        $(function() {
          $("#area_conhecimento").customselect();
        });
    </script>

<script type="text/javascript">
    $(function(){
        $('.single-slider').jRange({
            from: 0,
            to: 5,
            step: 1,
            scale: [0,1,2,3,4,5],
            format: '%s',
            width: 500,
            theme: 'theme-blue',
            showLabels: true
        });
    });

   

</script>
</head>
<script language="javascript">
        function mudaTab(qualTab) {
            if(qualTab == 1) {
                if(document.getElementsByName('nome')[0].value.length > 0 && document.getElementsByName('palavrachave')[0].value.length > 0 && document.getElementsByName('idioma')[0].value.length > 0 && document.getElementsByName('descricao')[0].value.length > 0 && (document.getElementsByName('url')[0].value != "http://" && document.getElementsByName('url')[0].value != "")) {
                    document.getElementsByName('nome')[0].style.border = "0";
                    document.getElementsByName('url')[0].style.border = "0";
                    document.getElementsByName('palavrachave')[0].style.border = "0";
                    document.getElementsByName('idioma')[0].style.border = "0";
                    document.getElementsByName('descricao')[0].style.border = "0";
                    divTab = document.getElementById('sub-conteudo');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab');
                    divTab = document.getElementById('sub-conteudo1');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab-active');
                    divTab = document.getElementById('menu');
                    document.getElementById('seta').removeAttribute('class');
                    document.getElementById('seta').setAttribute('class', 'meu-active');
                    document.getElementById('menudiv1').removeAttribute('class');
                    document.getElementById('menudiv1').setAttribute('class', 'meu-active');
                    document.getElementById('seta1').removeAttribute('class');
                    document.getElementById('seta1').setAttribute('class', 'seta-active');
                    document.getElementById('buttonNext').removeAttribute('onclick');
                    document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(2)');
                    document.getElementById('buttonPrevious').removeAttribute('style');
                    document.getElementById('buttonPrevious').setAttribute('style', 'float: none; display: inline;');
                    document.getElementById('buttonPrevious').removeAttribute('onclick');
                    document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(7)');
                }
                else {
                    if(document.getElementsByName('nome')[0].value.length == 0) {
                        document.getElementsByName('nome')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('nome')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('nome')[0].style.border = "0";
                    }
                    if(document.getElementsByName('url')[0].value.length == "" || document.getElementsByName('url')[0].value.length == "http://") {
                        document.getElementsByName('url')[0].style.border = "1px solid #dc8810";
                    }
                    else {
                        document.getElementsByName('url')[0].style.border = "0";
                    }
                    if(document.getElementsByName('palavrachave')[0].value.length == 0) {
                        document.getElementsByName('palavrachave')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('palavrachave')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('palavrachave')[0].style.border = "0";
                    }
                    if(document.getElementsByName('idioma')[0].value.length == 0) {
                        document.getElementsByName('idioma')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('idioma')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('idioma')[0].style.border = "0";
                    }
                    if(document.getElementsByName('descricao')[0].value.length == 0) {
                        document.getElementsByName('descricao')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('descricao')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('descricao')[0].style.border = "0";
                    }
                }
            }
            else if(qualTab == 2) {
                if(document.getElementsByName('date')[0].value.length > 0) {
                    document.getElementsByName('date')[0].style.border = "0";
                    divTab = document.getElementById('sub-conteudo1');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab');
                    divTab = document.getElementById('sub-conteudo2');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab-active');
                    document.getElementById('menudiv2').removeAttribute('class');
                    document.getElementById('menudiv2').setAttribute('class', 'meu-active');
                    document.getElementById('seta1').removeAttribute('class');
                    document.getElementById('seta1').setAttribute('class', 'meu-active');
                    document.getElementById('seta2').removeAttribute('class');
                    document.getElementById('seta2').setAttribute('class', 'seta-active');
                    document.getElementById('buttonNext').removeAttribute('onclick');
                    document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(3)');
                    document.getElementById('buttonPrevious').removeAttribute('onclick');
                    document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(8)');
                }
                else {
                    if(document.getElementsByName('date')[0].value.length == 0) {
                        document.getElementsByName('date')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('date')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('date')[0].style.border = "0";
                    }
                }

            }
            else if(qualTab == 3) {
                console.log("oi");
                divTab = document.getElementById('sub-conteudo2');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo3');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv3').removeAttribute('class');
                document.getElementById('menudiv3').setAttribute('class', 'meu-active');
                document.getElementById('seta2').removeAttribute('class');
                document.getElementById('seta2').setAttribute('class', 'meu-active');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta5').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(4)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(9)');

            }
            else if(qualTab == 4) {
                        console.log("oi");
                    divTab = document.getElementById('sub-conteudo3');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab');
                    divTab = document.getElementById('sub-conteudo6');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab-active');
                    document.getElementById('menudiv6').removeAttribute('class');
                    document.getElementById('menudiv6').setAttribute('class', 'meu-active');
                    document.getElementById('seta5').removeAttribute('class');
                    document.getElementById('seta5').setAttribute('class', 'meu-active');
                    document.getElementById('seta2').removeAttribute('class');
                    document.getElementById('seta2').setAttribute('class', 'meu-active');
                    document.getElementById('buttonPrevious').removeAttribute('onclick');
                    document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(11)');
                    document.getElementById('buttonNext').removeAttribute('style');
                    document.getElementById('buttonNext').setAttribute('style', 'float: none; display: none;');
                    document.getElementById('finisher').removeAttribute('style');
            }
            else if(qualTab == 7) {
                divTab = document.getElementById('sub-conteudo1');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv1').removeAttribute('class');
                document.getElementById('seta1').removeAttribute('class');
                document.getElementById('seta').removeAttribute('class');
                document.getElementById('seta').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(1)');
                document.getElementById('buttonPrevious').removeAttribute('style');
                document.getElementById('buttonPrevious').setAttribute('style', 'float: none; display: none;');
            }
            else if(qualTab == 8) {
                divTab = document.getElementById('sub-conteudo2');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo1');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv2').removeAttribute('class');
                document.getElementById('seta2').removeAttribute('class');
                document.getElementById('seta1').removeAttribute('class');
                document.getElementById('seta1').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(2)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(7)');
            }
            else if(qualTab == 9) {
                divTab = document.getElementById('sub-conteudo3');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo2');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv3').removeAttribute('class');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta2').removeAttribute('class');
                document.getElementById('seta2').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(3)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(8)');
            }
            else if(qualTab == 11) {
                divTab = document.getElementById('sub-conteudo6');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo3');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv6').removeAttribute('class');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta5').setAttribute('class', 'seta-active');
                document.getElementById('seta2').removeAttribute('class');
                document.getElementById('seta2').setAttribute('class', 'meu-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(4)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(9)');
                document.getElementById('finisher').removeAttribute('style');
                document.getElementById('finisher').setAttribute('style', 'float: none; display: none;');
                document.getElementById('buttonNext').removeAttribute('style');
            }
        }

    opacityTip = 0;
    function toolTip(id, texto) {
        div = document.getElementsByClassName('tooltiploco')[id-1];
        tooltip = document.createElement('div');
        tooltip.setAttribute('class', 'mensagemTooltiploco');
        tooltip.innerHTML = texto;
        div1 = document.createElement('div');
        div1.style.width = "200px";
        div1.appendChild(tooltip);
        div.appendChild(div1);
        opacityTip = 0;
        fadeInTip(id);
    }
    function deleteTooltip(id) {
        opacityTip = 1;
        fadeOutTip(id);
    }
    function fadeInTip(id) {
        div = document.getElementsByClassName('tooltiploco')[id-1].lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip+=0.1;
        tTip = setTimeout(function() {fadeInTip(id)}, 10);
        if (opacityTip >= 1) {
            clearTimeout(tTip);
        }
    }
    function fadeOutTip(id) {
        div = document.getElementsByClassName('tooltiploco')[id-1].lastChild.lastChild;
        div.style.opacity = opacityTip;
        opacityTip-=0.1;
        tTip1 = setTimeout(function() {fadeOutTip(id)}, 10);
        if (opacityTip <= 0) {
            div = document.getElementsByClassName('tooltiploco')[id-1];
            div.removeChild(div.lastChild);
            clearTimeout(tTip1);
        }
    }
</script>

    <script type="text/javascript">
    $(document).ready(function(){
        console.log("funfou!");
        $("#url").keyup(function () { //user types username on inputfiled
            console.log("funfou!");
            var url = $(this).val(); //get the string typed by user
            $.post('php/classes/check_URL.php', {'url':url}, function(data) { //make ajax call to check_username.php
            $("#status").html(data); //dump the data received from PHP page
        });
    });
    });
    </script>


    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_REGISTER_NOVO_OA); ?></div><div class="text-right" ><!--<a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a> --></div></div>
    <div class="cadastrobase-content">
    <form id="registrar_novo_OA" method="post" action="" name="registrar_novo_OA" class="form-horizontal" style="width: 100%;">
        <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['user_id']; ?>" />
        <div id="rootwizard">
            <div id="menu">
                <div id="menudiv" class="meu-active"><?php echo WORDING_GENERAL_INFORMATION; ?></div>
                <div id="seta" class="seta-active"></div>
                <div id="menudiv1"><?php echo WORDING_LIFE_CATEGORY; ?></div>
                <div id="seta1"></div>
                <div id="menudiv2"><?php echo WORDING_TECHNICAL_CATEGORY; ?></div>
                <div id="seta2"></div>
                <div id="menudiv3"><?php echo WORDING_EDUCATIONAL_CATEGORY; ?></div>
                <div id="seta5"></div>
                <div id="menudiv6"><?php echo WORDING_REGISTER_CHA; ?></div>
            </div>
            <div id="conteudo" class="clearfix">
            <!-- Inicio-->
                <div id="sub-conteudo" class="tab-active"> 
                    <div class="control-group">
                        <label class="control-label" for="name"><div style="float: left"><?php echo WORDING_NAME; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(1, '<?php echo HINT_NAME ?>')" onmouseout="deleteTooltip(1)">[ ? ]</div></div>
                        <div class="controls">
                            <input type="text" id="nome" name="nome" class="required">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="url"><?php echo WORDING_URL; ?></label>
                        <div class="controls">
                            <input type="url" id="url" name="url" value="http://" class="required url"> <!-- Deixar type URL pq buga no banco de dados -->
                            <div id="status"></div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="palavrachave"><div style="float: left"><?php echo WORDING_KEYWORDS; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(2, '<?php echo HINT_KEYWORD ?>')" onmouseout="deleteTooltip(2)">[ ? ]</div></div>
                        <div class="controls">
                            <!-- input class="palavra_chave" multiple="multiple" id="palavrachave" name="palavrachave" class="required"/-->
                            <input type="text" data-role="tagsinput" id="palavrachave" name="palavrachave" class="required" />
                            
                             <!-- TRADUZIR -->
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="idioma"><?php echo WORDING_LANGUAGE; ?></label>
                        <div class="controls">
                            <select id = "idioma" name="idioma">
                                <option value = "portugues"><?php echo WORDING_PORTUGUES ?></option>
                                <option value = "espanhol"><?php echo WORDING_SPANISH ?></option>
                                <option value = "ingles"><?php echo WORDING_ENGLISH ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- Área de conhecimento-->
                    <?php 
                    $OA = new OA();
                    $OA = $OA->getAreasConhecimento();
                    ?>

                    <div class="control-group">
                        <label class="control-label" for="descricao"><div style="float: left"><?php echo WORDING_KNOWLEDGE_AREA; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(3, '<?php echo HINT_KNOWLEDGE_AREA ?>')" onmouseout="deleteTooltip(3)">[ ? ]</div></div>
                        <div class="controls">
                            <select id="area_conhecimento" name="area_conhecimento" class="custom-select">
                            <option value=''>Selecione..</option>
                            <?php 
                            foreach ($OA as $OBJETO) {
                                echo '<option value="'.$OBJETO['area_conhecimento_id'].'">'.$OBJETO['nome_area_conhecimento'].'';
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    <!-- Descrição -->
                    <div class="control-group">
                        <label class="control-label" for="descricao"><div style="float: left"><?php echo WORDING_DESCRIPTION; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(4, '<?php echo HINT_DESCRIPTION ?>')" onmouseout="deleteTooltip(4)">[ ? ]</div></div>
                        <div class="controls">
                            <textarea name="descricao" id="descricao" ROWS="5" COLS="40"></textarea>
                        </div>
                    </div>
                </div>
                <!-- Fim-->
                <!-- Categoria Vida -->
                <div id="sub-conteudo1" class="tab">
                        <div class="control-group">
                            <label class="control-label" for="date"><div style="float: left"><?php echo WORDING_DATE; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(5, '<?php echo HINT_DATA ?>')" onmouseout="deleteTooltip(5)">[ ? ]</div></div>
                            <div class="controls">
                                <input id="date" type="text" name="date" required />
                            </div>
                        </div>
                </div>
                <!-- Categoria Técnica -->
                <div id="sub-conteudo2" class="tab">
                     <!-- FORMA DE UTILIZAÇÃO -->
                    <div class="control-group">
                        <label class="control-label" for="formaUtilizacao"><?php echo WORDING_UTILITY_TYPE; ?> </label>
                        <div class="controls">
                            <select id = "formaUtilizacao" name="formaUtilizacao" required="true">
                                <option value = "navegador"><?php echo WORDING_THROUGH_BROWSER ?></option>
                                <option value = "download"><?php echo WORDING_THROUGH_DOWNLOAD ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- TIPO FORMATO -->
                    <div class="control-group">
                        <label class="control-label" for="tipoOA"><?php echo WORDING_OA_TYPE; ?> (Utilize o CTRL para selecionar mais de um)</label>
                        <div class="controls">
                            <select id = "tipoOA[]" name="tipoOA[]" required="true" multiple>
                                <option value = "material multimidia"><?php echo WORDING_MULTIMIDIA_MATERIAL ?></option>
                                <option value = "animacao"><?php echo WORDING_ANIMATION ?></option>
                                <option value = "livro digital"><?php echo WORDING_DIGITAL_BOOK ?></option>
                                <option value = "jogo"><?php echo WORDING_GAME ?></option>
                                <option value = "documento"><?php echo WORDING_DOCUMENT ?></option>
                                <option value = "pagina web"><?php echo WORDING_WEB_PAGE ?></option>
                            </select>
                        </div>
                    </div>               
                </div>
                <!-- CATEGORIA EDUCACIONAL -->
                <div id="sub-conteudo3" class="tab">
                    <!-- DESCRIÇÃO EDUCACIONAL -->
                    <div class="control-group">
                        <label class="control-label" for="descricao_educacional"><div style="float: left"><?php echo WORDING_EDUCATIONAL_DESCRIPTION; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(6, '<?php echo HINT_EDUCACIONAL_DESCRIPTION ?>')" onmouseout="deleteTooltip(6)">[ ? ]</div></div>
                        <div class="controls">
                            <textarea name="descricao_educacional" id="descricao_educacional" ROWS="5" COLS="40"></textarea>
                        </div>
                    </div>
                    <!-- FAIXA ETÁRIA -->
                    <div class="control-group">
                        <label class="control-label" for="faixaEtaria"><?php echo WORDING_AGE_GROUP; ?> (Utilize o CTRL para selecionar mais de um)</label>
                        <div class="controls">
                            <select id = "faixaEtaria[]" name="faixaEtaria[]" required="true" multiple>
                                <option value = "educacao infantil"><?php echo WORDING_CHILD_EDUCATION ?></option>
                                <option value = "ensino fundamental"><?php echo WORDING_BASIC_EDUCATION ?></option>
                                <option value = "ensino medio"><?php echo WORDING_HIGHSCOOL ?></option>
                                <option value = "ensino profissionalizante"><?php echo WORDING_PROFESSIONAL_EDUCATION ?></option>
                                <option value = "ensino superior"><?php echo WORDING_COLLEGE ?></option>
                            </select>
                        </div>
                    </div>
                    <!-- RECURSO APRENDIZAGEM -->
                    <div class="control-group">
                        <label class="control-label" for="recursoAprendizagem"><?php echo WORDING_LEARNING_RESOURCE; ?></label>
                        <div class="controls">
                            <select id = "recursoAprendizagem" name="recursoAprendizagem" required="true">
                                <option value = "exercício"><?php echo WORDING_EXERCISE ?></option>
                                <option value = "simulação"><?php echo WORDING_SIMULATION ?></option>
                                <option value = "questionário"><?php echo WORDING_QUESTIONNAIRE ?></option>
                                <option value = "diagrama"><?php echo WORDING_DIAGRAM ?></option>
                                <option value = "figura"><?php echo WORDING_FIGURE ?></option>
                                <option value = "gráfico"><?php echo WORDING_GRAPHIC ?></option>
                                <option value = "video"><?php echo WORDING_VIDEO ?></option>
                                <option value = "indice"><?php echo WORDING_INDICE ?></option>
                                <option value = "slide"><?php echo WORDING_SLIDE ?></option>
                                <option value = "tabela"><?php echo WORDING_TABLE ?></option>
                                <option value = "teste"><?php echo WORDING_TEST ?></option>
                                <option value = "experiência"><?php echo WORDING_EXPERIENCE ?></option>
                                <option value = "texto"><?php echo WORDING_TEXT ?></option>
                                <option value = "problema"><?php echo WORDING_PROBLEM ?></option>
                                <option value = "auto avaliação"><?php echo WORDING_AUTO_AVALIATION ?></option>
                                <option value = "palestra"><?php echo WORDING_LECTURE ?></option>
                                <option value = "palestra"><?php echo WORDING_MULTIMIDIA_MATERIAL?></option>
                            </select>
                        </div>
                    </div>              
                </div>
                <!-- CATEGORIA DIREITO -->
                <!--div id="sub-conteudo4" class="tab"-->
                    <!-- CUSTO -->
                    <!--div class="control-group">
                        <label class="control-label" for="custo"><div style="float: left"><?php echo WORDING_COST ; ?></div><div style="float: left"><div class="tooltiploco"><div onmouseover="toolTip(13, '<?php echo HINT_COST ?>')" onmouseout="deleteTooltip(13)">?</div></div></div></label>
                        <div class="controls">
                            <input type="radio" name="custo" value="true" id="custo" checked><?php echo WORDING_YES?>
                            <input type="radio" name="custo" value="false" id="custo"><?php echo WORDING_NO ?>
                        </div>
                    </div-->                    
                    <!-- DIREITO AUTORAL -->
                    <!--div class="control-group">
                        <label class="control-label" for="direitoAutoral"><div style="float: left"><?php echo WORDING_COPYRIGHT ; ?></div><div style="float: left"><div class="tooltiploco"></label><div onmouseover="toolTip(14, '<?php echo HINT_AUTHORAL_LEGAL ?>')" onmouseout="deleteTooltip(14)">?</div></div></div></label>
                        <div class="controls">
                            <input type="radio" name="direitoAutoral" id="direitoAutoral" value="1" checked><?php echo WORDING_YES?>
                            <input type="radio" name="direitoAutoral" id="direitoAutoral" value="0"><?php echo WORDING_NO ?>
                        </div>
                    </div-->                    
                    <!-- USO -->
                    <!--div class="control-group">
                        <label class="control-label" for="uso"><div style="float: left"><?php echo WORDING_USE; ?></div><div style="float: left"><div class="tooltiploco"><div onmouseover="toolTip(15, '<?php echo HINT_USE ?>')" onmouseout="deleteTooltip(15)">?</div></div></div></label>
                        <div class="controls">
                            <textarea name="uso" id="uso" ROWS="5" COLS="40"></textarea>
                        </div>
                    </div>  
                </div-->

                <div id="sub-conteudo6" class="tab">
                    <!--TELA DE BOTAR NÚMERO NO CHA /-->
                    <!--input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" /-->     
                </div>

                <input id="finisher" style="display: none;" type="submit" name="registrar_novo_OA" value="<?php echo WORDING_REGISTER_OA; ?>" />
            </div> 
            <ul class="pager wizard">
                <li class="next" style="float:right"><div id="buttonNext" class='button-next text-left' onclick="mudaTab(1)"><a href="javascript:;">Próximo</a></div></li>
                <li class="previous" id="buttonPrevious" onclick="mudaTab(3)"><div class="text-right button-voltar"><a href="javascript:;">Voltar</a></div></li>
            </ul>   
        </div>
    </form>
    </div>
    <div class="fundoPreto"></div>
<?php// include('_footer.php'); ?>