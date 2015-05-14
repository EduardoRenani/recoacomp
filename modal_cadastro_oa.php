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
// include the config
require_once('config/config.cfg');

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/pt_br.php');

// include the PHPMailer library
require_once('libraries/PHPMailer.php');

// load the login class
require_once('classes/Login.php');

// Carrega classe de competências
require_once('classes/Competencia.php');

// Carrega classe dos objetos para serem associados
require_once("classes/OA.php");

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
        <link href="css/progress_cadastro_OA_breadcrumb.css" rel="stylesheet">
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



<script type="text/javascript">
    $(function() {
        $('#tabela2').sortable({
            connectWith: "#tabela1, #tabela1",
            receive : function (event, ui) {
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = "";
                for (i = 0; i < nomesCompetencias.length; i++) {
                    var elementoAdd = document.createElement('div');
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayOAS').value = arrayCompetencias;
            }
        });
    });

    $(function() {
        $('#tabela1').sortable({
            connectWith: "#tabela1, #tabela2",
            receive : function (event, ui)
            {
                
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = "";
                for (i = 0; i < nomesCompetencias.length; i++) {
                    var elementoAdd = document.createElement('div');
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayOAS').value = arrayCompetencias;
            }
        });
    });
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
                if(document.getElementsByName('nome')[0].value.length > 0 && document.getElementsByName('url')[0].value.length > 0 && document.getElementsByName('palavrachave')[0].value.length > 0 && document.getElementsByName('idioma')[0].value.length > 0 && document.getElementsByName('descricao')[0].value.length > 0) {
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
                    if(document.getElementsByName('url')[0].value.length == 0) {
                        document.getElementsByName('url')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('url')[0].setAttribute("placeholder", "Este campo é necessário");
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
                if(document.getElementsByName('date')[0].value.length > 0 && document.getElementsByName('entidade')[0].value.length > 0) {
                    document.getElementsByName('date')[0].style.border = "0";
                    document.getElementsByName('entidade')[0].style.border = "0";
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
                    if(document.getElementsByName('entidade')[0].value.length == 0) {
                        document.getElementsByName('entidade')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('entidade')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('entidade')[0].style.border = "0";
                    }
                }

            }
            else if(qualTab == 3) {
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
                document.getElementById('seta3').removeAttribute('class');
                document.getElementById('seta3').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(4)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(9)');

            }
            else if(qualTab == 4) {
                if(document.getElementsByName('descricao_educacional')[0].value.length > 0) {
                    document.getElementsByName('descricao_educacional')[0].style.border = "0";
                    divTab = document.getElementById('sub-conteudo3');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab');
                    divTab = document.getElementById('sub-conteudo4');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab-active');
                    document.getElementById('menudiv4').removeAttribute('class');
                    document.getElementById('menudiv4').setAttribute('class', 'meu-active');
                    document.getElementById('seta3').removeAttribute('class');
                    document.getElementById('seta3').setAttribute('class', 'meu-active');
                    document.getElementById('seta4').removeAttribute('class');
                    document.getElementById('seta4').setAttribute('class', 'seta-active');
                    document.getElementById('buttonNext').removeAttribute('onclick');
                    document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(5)');
                    document.getElementById('buttonPrevious').removeAttribute('onclick');
                    document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(10)');
                }
                else {
                    if(document.getElementsByName('descricao_educacional')[0].value.length == 0) {
                        document.getElementsByName('descricao_educacional')[0].style.border = "1px solid #dc8810";
                        document.getElementsByName('descricao_educacional')[0].setAttribute("placeholder", "Este campo é necessário");
                    }
                    else {
                        document.getElementsByName('date')[0].style.border = "0";
                    }
                }
            }
            else if(qualTab == 5) {
                divTab = document.getElementById('sub-conteudo4');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo5');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv5').removeAttribute('class');
                document.getElementById('menudiv5').setAttribute('class', 'meu-active');
                document.getElementById('seta4').removeAttribute('class');
                document.getElementById('seta4').setAttribute('class', 'meu-active');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta5').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(6)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(11)');
                mudaTab(6);
            }
            else if(qualTab == 6) {
                    divTab = document.getElementById('sub-conteudo5');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab');
                    divTab = document.getElementById('sub-conteudo6');
                    divTab.removeAttribute('class');
                    divTab.setAttribute('class', 'tab-active');
                    document.getElementById('menudiv6').removeAttribute('class');
                    document.getElementById('menudiv6').setAttribute('class', 'meu-active');
                    document.getElementById('seta5').removeAttribute('class');
                    document.getElementById('seta5').setAttribute('class', 'meu-active');
                    document.getElementById('buttonPrevious').removeAttribute('onclick');
                    document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(12)');
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
                document.getElementById('seta3').removeAttribute('class');
                document.getElementById('seta2').removeAttribute('class');
                document.getElementById('seta2').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(3)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(8)');
            }
            else if(qualTab == 10) {
                divTab = document.getElementById('sub-conteudo4');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo3');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv4').removeAttribute('class');
                document.getElementById('seta4').removeAttribute('class');
                document.getElementById('seta3').removeAttribute('class');
                document.getElementById('seta3').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(4)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(9)');
            }
            else if(qualTab == 11) {
                divTab = document.getElementById('sub-conteudo5');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo4');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv5').removeAttribute('class');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta4').removeAttribute('class');
                document.getElementById('seta4').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(5)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(10)');
                document.getElementById('finisher').removeAttribute('style');
                document.getElementById('finisher').setAttribute('style', 'float: none; display: none;');
                document.getElementById('buttonNext').removeAttribute('style');
            }
            else if(qualTab == 12) {
                divTab = document.getElementById('sub-conteudo6');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo5');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv6').removeAttribute('class');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta5').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(6)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(11)');
                document.getElementById('finisher').removeAttribute('style');
                document.getElementById('finisher').setAttribute('style', 'float: none; display: none;');
                document.getElementById('buttonNext').removeAttribute('style');
                mudaTab(11);
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

    <script>
    //Declara uma nova requisição ajax
    function fazAjax(){
        console.log('chamou o faz');
        var meu_ajax = new XMLHttpRequest();

        //Declara um "conteiner" de dados para serem enviados por POST
        var formData = new FormData();
        var listaExclusao = $("#tabela2").sortable('toArray').toString();
        //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
        formData.append( 'listaExclusao', listaExclusao ); //$_POST['variavel'] === 'dado
        //Configuração do ajax: qual o "tipo" (no caso, POST) e qual a página que será acessada (no caso, ajax_page.php)
        //( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
        meu_ajax.open( 'POST', './competencias.php', true );

        //Configurar a função que será chamada quando a requisição mudar de estado

        meu_ajax.onreadystatechange = function () {
            if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
                if ( meu_ajax.status === 200 ) { //status === 200: sucesso
                    if ( meu_ajax.responseText.length > 0 ) {
                        var array = JSON.parse(meu_ajax.responseText);
                        var element_tabela1 = document.getElementById('tabela1');
                        for(var i = 0; i < array.length; i++) {
                            if ( element_tabela1.innerHTML.indexOf(array[i]) === -1) {
                                element_tabela1.innerHTML += array[i];
                            }
                        }
                        //Resposta não-vazia
                    } else {
                        //Resposta vazia
                    }
                } else if ( meu_ajax.status !== 0 ) { //status !== 200: erro ( meu_ajax.status === 0: ajax não enviado )
                    console.log( 'DEU ERRO NO AJAX: '+meu_ajax.responseText );
                }
            }
        };
        meu_ajax.send( formData );
    }
    $(function(){fazAjax()});
    $(window).blur(function(){fazAjax();});
    $(window).focus(function(){fazAjax();});
    $(window).mouseup(function(){fazAjax();});
    </script>

    <script type="text/javascript">
    $(document).ready(function(){
        console.log("funfou!");
        $("#url").keyup(function () { //user types username on inputfiled
            console.log("funfou!");
            var url = $(this).val(); //get the string typed by user
            $.post('classes/check_URL.php', {'url':url}, function(data) { //make ajax call to check_username.php
            $("#status").html(data); //dump the data received from PHP page
        });
    });
    });
    </script>

<!--<div class="fixedBackgroundGradient"></div>-->
<!-- clean separation of HTML and PHP -->
 <!--   <div class="cadastrobase"> -->

    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_REGISTER_NOVO_OA); ?></div><div class="text-right" ><!--<a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a> --></div></div>
    <div class="cadastrobase-content">
    <form id="registrar_novo_OA_modal" method="post" action="" name="registrar_novo_OA_modal" class="form-horizontal" style="width: 100%;">
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
                <div id="seta3"></div>
                <div id="menudiv4"><?php echo WORDING_RIGHT_CATEGORY; ?></div>
                <div id="seta4"></div>
                <div id="menudiv5"><?php echo WORDING_ASSOCIATE_COMPETENCE; ?></div>
                <div id="seta5"></div>
                <div id="menudiv6"><?php echo WORDING_REGISTER_CHA; ?></div>
            </div>
            <div id="conteudo" class="clearfix">
            <!-- Inicio-->
                <div id="sub-conteudo" class="tab-active"> 
                    <div class="control-group">
                        <label class="control-label" for="name"><?php echo WORDING_NAME; ?></label>
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
                        <label class="control-label" for="palavrachave"><?php echo WORDING_KEYWORDS; ?></label>
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
                    <!-- Descrição -->
                    <div class="control-group">
                        <label class="control-label" for="descricao"><?php echo WORDING_DESCRIPTION; ?></label>
                        <div class="controls">
                            <textarea name="descricao" id="descricao" ROWS="5" COLS="40"></textarea>
                        </div>
                    </div>          
                </div>
                <!-- Fim-->
                <div id="sub-conteudo1" class="tab">
                        <div class="control-group">
                            <label class="control-label" for="date"><div style="float: left"><?php echo WORDING_DATE; ?></div><div class="tooltiploco"><div onmouseover="toolTip(1, 'Data que o objeto foi criado')" onmouseout="deleteTooltip(1)">?</div></div></label>
                            <div class="controls">
                                <input id="date" type="text" name="date" required />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="status"><?php echo WORDING_STATUS; ?></label>
                            <div class="controls">
                                    <select id = "status" name="status" required="true">
                                        <option value = "revisado"><?php echo WORDING_REVISED ?></option>
                                        <option value = "rascunho"><?php echo WORDING_DRAFT ?></option>
                                        <option value = "editado"><?php echo WORDING_EDITED ?></option>
                                        <option value = "indisponível"><?php echo WORDING_UNAVAILABLE ?></option>
                                        <option value = "final"><?php echo WORDING_FINAL ?></option>
                                    </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="versao"><?php echo WORDING_VERSION; ?></label>
                            <div class="controls">
                                    <input id="versao" type="number" name="versao" min="0" max="100" step="0.1" value="1" class="required">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="entidade"><?php echo WORDING_ENTITY; ?></label>
                            <div class="controls">
                                    <input id="entidade" type="text" name="entidade" class="required" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="contribuicao"><?php echo WORDING_CONTRIBUTION; ?></label>
                            <div class="controls">
                                        <select id = "contribuicao" name="contribuicao" required="true">
                                            <option value = "autor"><?php echo WORDING_AUTHOR ?></option>
                                            <option value = "editor"><?php echo WORDING_EDITOR ?></option>
                                            <option value = "deconhecido"><?php echo WORDING_UNKNOWN ?></option>
                                            <option value = "iniciador"><?php echo WORDING_INICIATOR ?></option>
                                            <option value = "designer gráfico"><?php echo WORDING_GRAPHIC_DESIGNER ?></option>
                                            <option value = "técnico"><?php echo WORDING_TECHNICAL ?></option>
                                            <option value = "provedor de conteúdo"><?php echo WORDING_CONTENT_PROVIDER ?></option>
                                            <option value = "roteirista"><?php echo WORDING_ROTEIRIST ?></option>
                                            <option value = "designer instrucional"><?php echo WORDING_INSTRUCTIONAL_DESIGNER ?></option>
                                            <option value = "especialista em conteúdo"><?php echo WORDING_CONTENT_SPECIALIST ?></option>
                                        </select>
                            </div>
                        </div>
                </div>
                <div id="sub-conteudo2" class="tab">
                     <!-- TEMPO DO VIDEO -->
                    <div class="control-group">
                        <label class="control-label" for="tempo_video"><?php echo WORDING_VIDEO_TIME; ?></label>
                        <div class="controls">
                            <input type="time" name="tempo_video">
                        </div>
                    </div>
                     <!-- TAMANHO -->
                    <div class="control-group">
                        <label class="control-label" for="tamanho"><?php echo WORDING_SIZE; ?></label>
                        <div class="controls">
                             <input id="tamanho" type="number" name="tamanho" min="0" max="100" step="0.1" value="1" class="required">
                        </div>
                    </div>
                     <!-- TIPO TECNOLOGIA -->
                    <div class="control-group">
                        <label class="control-label" for="tipoTecnologia"><?php echo WORDING_TECHNOLOGY_TYPE; ?></label>
                        <div class="controls">
                            <select id = "tipoTecnologia" name="tipoTecnologia" required="true">
                                <option value = "navegador"><?php echo WORDING_BROWSER ?></option>
                                <option value = "sistema operacional"><?php echo WORDING_OPERATIONAL_SYSTEM ?></option>
                            </select>
                        </div>
                    </div>                 
                    <!-- TIPO FORMATO -->
                    <div class="control-group">
                        <label class="control-label" for="tipoFormato"><?php echo WORDING_FORMAT; ?></label>
                        <div class="controls">
                            <select id = "tipoFormato" name="tipoFormato" required="true">
                                <option value = "video"><?php echo WORDING_VIDEO ?></option>
                                <option value = "sistema operacional"><?php echo WORDING_OPERATIONAL_SYSTEM ?></option>
                                <option value = "imagem"><?php echo WORDING_IMAGE ?></option>
                                <option value = "audio"><?php echo WORDING_AUDIO ?></option>
                                <option value = "texto"><?php echo WORDING_TEXT ?></option>
                                <option value = "apresentação"><?php echo WORDING_APRESENTATION ?></option>
                                <option value = "pdf"><?php echo WORDING_PDF ?></option>
                                <option value = "site"><?php echo WORDING_SITE ?></option>
                            </select>
                        </div>
                    </div>               
                </div>
                <!-- CATEGORIA EDUCACIONAL -->
                <div id="sub-conteudo3" class="tab">
                    <!-- DESCRIÇÃO EDUCACIONAL -->
                    <div class="control-group">
                        <label class="control-label" for="descricao_educacional"><?php echo WORDING_EDUCATIONAL_DESCRIPTION; ?></label>
                        <div class="controls">
                            <textarea name="descricao_educacional" id="descricao_educacional" ROWS="5" COLS="40"></textarea>
                        </div>
                    </div>
                     <!-- NÍVEL ITERATIVIDADE -->
                    <div class="control-group">
                        <label class="control-label" for="nivelIteratividade"><?php echo WORDING_ITERABILITY_NIVEL; ?></label>
                        <div class="controls">
                                <select id = "nivelIteratividade" name="nivelIteratividade" required="true">
                                    <option value = "muito baixa"><?php echo WORDING_VERY_LOW ?></option>
                                    <option value = "baixa"><?php echo WORDING_LOW ?></option>
                                    <option value = "médio"><?php echo WORDING_MIDDLE ?></option>
                                    <option value = "alto"><?php echo WORDING_HIGH ?></option>
                                    <option value = "muito alto"><?php echo WORDING_VERY_HIGH ?></option>
                                </select>
                        </div>
                    </div>               
                    <!-- TIPO ITERATIVIDADE -->
                    <div class="control-group">
                        <label class="control-label" for="tipoIteratividade"><?php echo WORDING_ITERABILITY_TYPE; ?></label>
                        <div class="controls">
                            <select id = "tipoIteratividade" name="tipoIteratividade" required="true">
                                <option value = "ativa"><?php echo WORDING_ACTIVE ?></option>
                                <option value = "expositiva"><?php echo WORDING_EXPOSITORY ?></option>
                                <option value = "mista"><?php echo WORDING_MIXED ?></option>
                            </select>
                        </div>
                    </div>              
                    <!-- FAIXA ETÁRIA -->
                    <div class="control-group">
                        <label class="control-label" for="faixaEtaria"><?php echo WORDING_AGE_GROUP; ?></label>
                        <div class="controls">
                            <select id = "faixaEtaria" name="faixaEtaria" required="true">
                                <option value = "criança"><?php echo WORDING_CHILD ?></option>
                                <option value = "adulto"><?php echo WORDING_ADULT ?></option>
                                <option value = "idoso"><?php echo WORDING_ELDERLY ?></option>
                                <option value = "todas as idades"><?php echo WORDING_ALL_AGES ?></option>
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
                            </select>
                        </div>
                    </div>              
                    <!-- USUÁRIO FINAL -->
                    <div class="control-group">
                        <label class="control-label" for="usuarioFinal"><?php echo WORDING_FINAL_USER ; ?></label>
                        <div class="controls">
                        <select id = "usuarioFinal" name="usuarioFinal" required="true">
                            <option value = "professor"><?php echo WORDING_PROFESSOR ?></option>
                            <option value = "autor"><?php echo WORDING_AUTHOR ?></option>
                            <option value = "aluno"><?php echo WORDING_STUDENT ?></option>
                            <option value = "admin"><?php echo WORDING_ADMIN ?></option>
                        </select>
                        </div>
                    </div>              
                    <!-- AMBIENTE -->
                    <div class="control-group">
                        <label class="control-label" for="ambiente"><?php echo WORDING_AMBIENT ; ?></label>
                        <div class="controls">
                        <select id = "ambiente" name="ambiente" required="true">
                            <option value = "escola"><?php echo WORDING_SCHOOL ?></option>
                            <option value = "faculdade"><?php echo WORDING_COLLEGE ?></option>
                            <option value = "treinamento"><?php echo WORDING_TRAINING ?></option>
                            <option value = "outro"><?php echo WORDING_OTHER ?></option>
                        </select>
                        </div>
                    </div>              
                </div>
                <!-- CATEGORIA DIREITO -->
                <div id="sub-conteudo4" class="tab">
                    <!-- CUSTO -->
                    <div class="control-group">
                        <label class="control-label" for="custo"><?php echo WORDING_COST ; ?></label>
                        <div class="controls">
                            <input type="radio" name="custo" value="true" id="custo" checked><?php echo WORDING_YES?>
                            <input type="radio" name="custo" value="false" id="custo"><?php echo WORDING_NO ?>
                        </div>
                    </div>                  
                    <!-- DIREITO AUTORAL -->
                    <div class="control-group">
                        <label class="control-label" for="direitoAutoral"><?php echo WORDING_COPYRIGHT ; ?></label>
                        <div class="controls">
                            <input type="radio" name="direitoAutoral" id="direitoAutoral" value="1" checked><?php echo WORDING_YES?>
                            <input type="radio" name="direitoAutoral" id="direitoAutoral" value="0"><?php echo WORDING_NO ?>
                        </div>
                    </div>                  
                    <!-- USO -->
                    <div class="control-group">
                        <label class="control-label" for="uso"><?php echo WORDING_USE; ?></label>
                        <div class="controls">
                            <textarea name="uso" id="uso" ROWS="5" COLS="40"></textarea>
                        </div>
                    </div>  

                
                </div>

                <div id="sub-conteudo5" style="background-image: url(img/seta_drag.png); background-repeat: no-repeat; background-position: 49.5% 40%; background-size: 50px;" class="tab">
                    <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
                    <span style="display block; width: 100%; float: left; text-align:center;"><?php echo WORDING_ASSOCIATE_COMP; ?>.</span>
                    <span style="display block; width: 40%; float: left; text-align:left;">Competencias Disponíveis</span><span style="display: block; width: 30%; float: right; text-align:right;">Competencias Selecionadas</span>
                    <ul id="tabela1">
                    </ul>

                    
                    <ul id="tabela2">
                    <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
                    </ul>
                     
            

                    <!-- <div onclick="modalCompetencia();"  class='botao-cadastra' style='width: 240px'><?=WORDING_CREATE_NEW_COMPETENCIA?></div> -->
                
                </div>


                <div id="sub-conteudo6" class="tab">
                    <!--input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" /-->
       
                     
            

                          
                </div>



                <input id="finisher" style="display: none;" type="submit" name="registrar_novo_OA_modal" value="<?php echo WORDING_REGISTER_OA; ?>" />
                
                                
                <ul class="pager wizard">
                        <li class="next" style="float:none"><div id="buttonNext" class='button' onclick="mudaTab(1)"><a href="javascript:;" class='button-next text-left'>Próximo</a></div></li>
                        <li class="previous" style="float:none; display: none;" id="buttonPrevious" onclick="mudaTab(3)"><div class="text-right"><a href="javascript:;">Voltar</a></div></li>
                </ul>     
            </div>  
        </div>
    </form>
    </div>
        <!--</div>-->

<!--<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>-->
<?php// include('_footer.php'); ?>