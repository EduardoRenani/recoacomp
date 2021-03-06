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
require_once('config/base.php');

$competencia = new Competencia();

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
    <script src="js/tooltip.js" type="text/javascript"></script>
    

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
        $("#busca-competencias").keyup(function(e) {
        $("#tabela1 li").hide();
        _pesquisa = $(this);
        tecla = (e.keyCode ? e.keyCode : e.which);
        if(tecla == 27){ 
            _pesquisa.val('');  
            $("#tabela1 li").show();
        }else{
            $('#tabela1 li').each(function(){
               if($(this).attr('name').toUpperCase().indexOf(_pesquisa.val().toUpperCase()) != -1){
                   $(this).show();
               }
            }); 
        }
        });


        $('#tabela2').sortable({
            connectWith: "#tabela1, #tabela1",
            receive : function (event, ui) {
                $('.mensagemTooltipSortable').remove();
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = '<div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0_DISCI."<br>".HINT_CHA_1_DISCI."<br>".HINT_CHA_2_DISCI."<br>".HINT_CHA_3_DISCI."<br>".HINT_CHA_4_DISCI;?></div>';
                for (i = 0; i < nomesCompetencias.length; i++) {
                    var elementoAdd = document.createElement('div');
                    elementoAdd.innerHTML = '<hr class="competencia-dividor"><div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'conhecimento'+idCompetencias[i]+'\', \'conhecimento\')" onmouseout="deleteTooltipCHA(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'habilidade'+idCompetencias[i]+'\', \'habilidade\')" onmouseout="deleteTooltipCHA(\'habilidade'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'atitude'+idCompetencias[i]+'\', \'atitude\')" onmouseout="deleteTooltipCHA(\'atitude'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                $('.mensagemTooltipSortable').remove();
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayOAS').value = arrayCompetencias+",";
            }
        });
    });

    $(function() {
        $('#tabela1').sortable({
            connectWith: "#tabela1, #tabela2",
            receive : function (event, ui)
            {
                
                $('.mensagemTooltipSortable').remove();
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = '<div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0_DISCI."<br>".HINT_CHA_1_DISCI."<br>".HINT_CHA_2_DISCI."<br>".HINT_CHA_3_DISCI."<br>".HINT_CHA_4_DISCI;?></div>';
                for (i = 0; i < nomesCompetencias.length; i++) {
                    var elementoAdd = document.createElement('div');
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'conhecimento'+idCompetencias[i]+'\', \'conhecimento\')" onmouseout="deleteTooltipCHA(\'conhecimento'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'habilidade'+idCompetencias[i]+'\', \'habilidade\')" onmouseout="deleteTooltipCHA(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'atitude'+idCompetencias[i]+'\', \'atitude\')" onmouseout="deleteTooltipCHA(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                $('.mensagemTooltipSortable').remove();
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayOAS').value = arrayCompetencias+",";
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

    <script type="text/javascript">
    $(document).ready(function(){
        console.log("funfou!");
        $("#nome").keyup(function () { //user types username on inputfiled
            console.log("funfou!");
            var nome = $(this).val(); //get the string typed by user
            $.post('php/classes/check_Competencia.php', {'nome':nome}, function(data) { //make ajax call to check_username.php
            $("#status").html(data); //dump the data received from PHP page
        });
    });
    });
    </script>

</head>

<script>
//Declara uma nova requisição ajax
function fazAjaxCompetencias(){
    console.log('chamou o faz');
    var meu_ajax = new XMLHttpRequest();

    //Declara um "conteiner" de dados para serem enviados por POST
    var formData = new FormData();
    var listaExclusao = $("#tabela2").sortable('toArray').toString();
    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
    formData.append( 'listaExclusao', listaExclusao ); //$_POST['variavel'] === 'dado
    //Configuração do ajax: qual o "tipo" (no caso, POST) e qual a página que será acessada (no caso, ajax_page.php)
    //( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
    meu_ajax.open( 'POST', './oa.php', true );

    //Configurar a função que será chamada quando a requisição mudar de estado

    meu_ajax.onreadystatechange = function () {
        if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
            if ( meu_ajax.status === 200 ) { //status === 200: sucesso
                if ( meu_ajax.responseText.length > 0 ) {
                    var array = JSON.parse(meu_ajax.responseText);
                    var element_tabela1 = document.getElementById('tabela1');
                    for(var i = 0; i < array.length; i++) {
                        name = $(array[i]).attr('name');
                        if ( element_tabela1.innerHTML.indexOf(name) === -1) {
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
$(function(){fazAjaxCompetencias()});
$(window).blur(function(){fazAjaxCompetencias();});
$(window).focus(function(){fazAjaxCompetencias();});
$(window).mouseup(function(){fazAjaxCompetencias();});
</script>

<script language="javascript">
    function mudaTab(qualTab) {
        if(qualTab == 1) {
            if(document.getElementById('status').innerHTML == "OK" && document.getElementsByName('nome')[0].value.length > 2 && document.getElementsByName('descricaoNome')[0].value.length > 0 && document.getElementsByName('descricaoNome')[0].value.length < 200 && document.getElementsByName('conhecimentoDescricao')[0].value.length > 0 && document.getElementsByName('habilidadeDescricao')[0].value.length > 0 && document.getElementsByName('atitudeDescricao')[0].value.length > 0) {
                document.getElementsByName('nome')[0].style.border = "0";
                document.getElementsByName('descricaoNome')[0].style.border = "0";
                document.getElementsByName('conhecimentoDescricao')[0].style.border = "0";
                document.getElementsByName('habilidadeDescricao')[0].style.border = "0";
                document.getElementsByName('atitudeDescricao')[0].style.border = "0";
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
            }
            else {
                if(document.getElementsByName('nome')[0].value.length == 0) {
                    document.getElementsByName('nome')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('nome')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else if(document.getElementsByName('nome')[0].value.length < 3) {
                    document.getElementsByName('nome')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('nome')[0].value = "No mínimo 3 dígitos!";
                }
                else {
                    document.getElementsByName('nome')[0].style.border = "0";
                }
                if(document.getElementsByName('descricaoNome')[0].value.length == 0) {
                    document.getElementsByName('descricaoNome')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('descricaoNome')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('descricaoNome')[0].style.border = "0";
                }
                if(document.getElementsByName('conhecimentoDescricao')[0].value.length == 0) {
                    document.getElementsByName('conhecimentoDescricao')[0].parentNode.style.border = "1px solid #dc8810";
                    //document.getElementsByName('conhecimentoDescricao')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('conhecimentoDescricao')[0].style.border = "0";
                }
                if(document.getElementsByName('habilidadeDescricao')[0].value.length == 0) {
                    document.getElementsByName('habilidadeDescricao')[0].parentNode.style.border = "1px solid #dc8810";
                    document.getElementsByName('habilidadeDescricao')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('habilidadeDescricao')[0].style.border = "0";
                }
                if(document.getElementsByName('atitudeDescricao')[0].value.length == 0) {
                    document.getElementsByName('atitudeDescricao')[0].parentNode.style.border = "1px solid #dc8810";
                    document.getElementsByName('atitudeDescricao')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('atitudeDescricao')[0].style.border = "0";
                }
            }
        }
        else if(qualTab == 2) {
            if(document.getElementsByName('arrayOAS')[0].value.length > 1) {
                document.getElementById('tabela1').style.border = "0";
                document.getElementById('tabela2').style.border = "0";
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
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('finisher').removeAttribute('style');
                document.getElementById('buttonNext').removeAttribute('style');
                document.getElementById('buttonNext').setAttribute('style', 'float: none; display: none;');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(4)');
            }
            else {
                document.getElementById("sub-conteudo1").getElementsByTagName('span')[1].innerHTML = "<span style='color: #dc8810'>Escolha uma competência";
                document.getElementById("tabela1").style.border = "1px solid #dc8810";
                document.getElementById("tabela2").style.border = "1px solid #dc8810";
                window.scrollTo(0, 0);
            }
        }
        else if(qualTab == 3) {
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
        else if(qualTab == 4) {
            divTab = document.getElementById('sub-conteudo2');
            divTab.removeAttribute('class');
            divTab.setAttribute('class', 'tab');
            divTab = document.getElementById('sub-conteudo1');
            divTab.removeAttribute('class');
            divTab.setAttribute('class', 'tab-active');
            document.getElementById('menudiv2').removeAttribute('class');
            document.getElementById('seta1').removeAttribute('class');
            document.getElementById('seta1').setAttribute('class', 'seta-active');
            document.getElementById('buttonNext').removeAttribute('onclick');
            document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(2)');
            document.getElementById('buttonPrevious').removeAttribute('onclick');
            document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(3)');
            document.getElementById('buttonNext').removeAttribute('style');
            document.getElementById('finisher').setAttribute('style', 'float: none; display: none;');

        }
    }

    opacityModal = 0;
    function fadeInModal() {
        div = document.getElementById('modal-oa');
        divDelete = document.getElementById('closeModal');
        divFundo = document.getElementsByClassName('fundoPreto')[0];
        divFundo.style.display = "block";
        divFundo.style.opacity = opacityModal;
        div.style.opacity = opacityModal;
        divDelete.style.opacity = opacityModal;
        opacityModal+=0.01;
        tModal = setTimeout(function() {fadeInModal()}, 1);
        if (opacityModal >= 1) {
            clearTimeout(tModal);
        }
    }

    function fadeOutModal() {
        div = document.getElementById('modal-oa');
        div1 = document.getElementById('closeModal');
        divFundo = document.getElementsByClassName('fundoPreto')[0];
        divFundo.style.opacity = opacityModal;
        div1.style.opacity = opacityModal;
        div.style.opacity = opacityModal;
        opacityModal-=0.01;
        tFadeOutModal = setTimeout(function() {fadeOutModal()}, 1);
        if (opacityModal <= 0) {
            divFundo.style.display = "none";
            divDelete = document.getElementById('modal-oa');
            divDelete.parentNode.removeChild(divDelete);
            divDeleteClose = document.getElementById('closeModal');
            divDeleteClose.parentNode.removeChild(divDeleteClose);
            fazAjaxCompetencias();
            clearInterval(window.tDeleteModal);
            clearTimeout(tFadeOutModal);
            tAtualizaOA = setInterval('atualizaOA()', 1);
        }
    }

    function deleteModal() {
        if(document.getElementById('modal-oa').contentDocument) {
            if(document.getElementById('modal-oa').contentDocument.getElementsByClassName('disciplinas-list').length != 0) {
                fadeOutModal();
                clearInterval(window.tDeleteModal);
            }
        }
    }

    function modalCompetencia() {
        modalClose = document.createElement('div');
        modalClose.setAttribute("id", "closeModal");
        modalClose.setAttribute("class", "text-right");
        modalClose.setAttribute("onclick", "fadeOutModal()");
        modalClose.setAttribute("style", "position: absolute; top: 8.5%; left: 0; font-size: 20px; z-index: 9999; width: 100%; padding-right: 33px;l");
        modalClose.innerHTML = '<a href="#"><span class="glyphicon glyphicon-remove"></span></a>';
        modal = document.createElement("iframe");
        modal.setAttribute("src", "modal_cadastro_oa.php");
        modal.setAttribute("id", "modal-oa");
        modal.setAttribute("style", "position: absolute; z-index: 9998; top: 7%; left: 2.5%; width: 95%; height: 810px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
        modal.setAttribute("frameborder", "0");

        document.body.appendChild(modal);
        document.body.appendChild(modalClose);
        fadeInModal();
        tDeleteModal = setInterval("deleteModal()", 1);
        tPegaOA = setInterval("pegaOA()", 1);
    }

    function pegaOA() {
        console.log(document.getElementById('modal-oa').contentDocument);
        if(document.getElementById('modal-oa').contentDocument.getElementById('oacadastrado')) {
            idOA = document.getElementById('modal-oa').contentDocument.getElementById('oacadastrado').value;
            console.log("oi hahaha chegou");
            document.getElementById('arrayOAS').value += idOA+',';
            clearInterval(window.tPegaOA);
        }
    }

    function atualizaOA() {
        novoOA = document.getElementById('arrayOAS').value;
        novoOA = novoOA.split(',');
        sizeOA = novoOA.length-2;
        if(document.getElementById(novoOA[novoOA.length-2])) {
            if(cloneOA = document.getElementById(novoOA[novoOA.length-2]).cloneNode(true)) {
                document.getElementById(novoOA[novoOA.length-2]).parentNode.removeChild(document.getElementById(novoOA[novoOA.length-2]).parentNode.lastChild)
                console.log(document.getElementById(novoOA[novoOA.length-2]));
                console.log(cloneOA);
                document.getElementById('tabela2').appendChild(cloneOA);
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = "";
                for (i = 0; i < nomesCompetencias.length; i++) {
                    var elementoAdd = document.createElement('div');
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'conhecimento'+idCompetencias[i]+'\', \'conhecimento\')" onmouseout="deleteTooltipCHA(\'conhecimento'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'habilidade'+idCompetencias[i]+'\', \'habilidade\')" onmouseout="deleteTooltipCHA(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipCHA(\'atitude'+idCompetencias[i]+'\', \'atitude\')" onmouseout="deleteTooltipCHA(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                clearInterval(window.tAtualizaOA);
            }
        }
    }
</script>





<!--<div class="fixedBackgroundGradient"></div>-->
<!-- clean separation of HTML and PHP -->

<!--<div class="cadastrobase clearfix" >-->
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_CREATE_COMPETENCA); ?></div></div>
        <div class="cadastrobase-content">
            <form method="post" action="" name="registrar_nova_competencia" id="registrar_nova_competencia">
                <!-- ID do usuário passado via hidden POST -->
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                    <div id="rootwizard">
                        <div id="menu">
                            <div id="menudiv" class="meu-active"><?php echo WORDING_GENERAL_INFORMATION; ?></div>
                            <div id="seta" class="seta-active"></div>
                            <div id="menudiv1"><?php echo WORDING_OA; ?></div>
                            <div id="seta1"></div>
                            <div id="menudiv2"><?php echo WORDING_OA_CHA; ?></div>
                    </div>
                        <div id="conteudo" class="clearfix">
                            <div id="sub-conteudo" class="tab-active">
                                <div class="control-group">
                                    <label class="control-label" for="nome"><?php echo WORDING_NAME; ?></label>
                                    <div class="controls">
                                        <input type="text" id="nome" name="nome" class="required">
                                        <div id="status"></div>      
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="descricaoNome"><?php echo WORDING_COMPETENCIA_DESCRICAO; ?></label><div class="tooltiploco"></label><div onmouseover="toolTip(1, ' Conjunto de elementos compostos pelos Conhecimentos, Habilidades e pelas Atitudes, sintetizados na sigla CHA. Tal conjunto é estruturado em um contexto determinado com o intuito de solucionar um problema, lidar com uma situação nova. Ex.: competência COMUNICAÇÃO -  está fundamentada na clareza e na objetividade da expressão oral, gestual e escrita.')" onmouseout="deleteTooltip(1)">[?]</div></div>
                                    <div class="controls">
                                        <textarea name="descricaoNome" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="conhecimentoDescricao"><?php echo WORDING_CONHECIMENTO_DESCRICAO; ?></label><div class="tooltiploco"></label><div onmouseover="toolTip(1, ' Relacionado ao saber conhecer; refere-se à representação organizada da realidade. Ex: Com relação ao ato de comunicar - Norma culta da língua, compreender regras de comportamento, formas de comunicação, público/receptores.')" onmouseout="deleteTooltip(1)">[?]</div></div>
                                    <div class="controls">
                                        <input type="text" data-role="tagsinput" id="conhecimentoDescricao" name="conhecimentoDescricao" class="required" />
                                        <!--textarea name="conhecimentoDescricao" Rows="5" COLS="40"></textarea-->
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="habilidadeDescricao"><?php echo WORDING_HABILIDADE_DESCRICAO; ?></label><div class="tooltiploco"></label><div onmouseover="toolTip(1, ' Relacionada ao saber fazer, refere-se aos conhecimentos processuais e procedimentais para aresolução de um problema. Ex: Com relação ao ato de comunicar – Escrever de forma clara, objetiva e coerente; interpretar mensagens recebidas; saber como impostar a voz; saber articular as palavras e usar vocabulário adequado.')" onmouseout="deleteTooltip(1)">[?]</div></div>
                                    <div class="controls">
                                        <input type="text" data-role="tagsinput" id="habilidadeDescricao" name="habilidadeDescricao" class="required" />
                                        <!--textarea name="habilidadeDescricao" Rows="5" COLS="40"></textarea-->
                                    </div>
                                </div>  
                                <div class="control-group">
                                    <label class="control-label" for="atitudeDescricao"><?php echo WORDING_ATITUDE_DESCRICAO; ?></label><div class="tooltiploco"></label><div onmouseover="toolTip(1, '  Relacionada ao saber ser e conviver; refere-se a aspectos sociais e afetivos que orientam  a conduta em relação aos outros, ao trabalho ou a situações. Ex.: Com relação ao ato de comunicar - Ser expressivo, empático, cauteloso e articulado.')" onmouseout="deleteTooltip(1)">[?]</div></div>
                                    <div class="controls">
                                        <input type="text" data-role="tagsinput" id="atitudeDescricao" name="atitudeDescricao" class="required" />
                                        <!-- textarea name="atitudeDescricao" Rows="5" COLS="40"></textarea-->
                                    </div>
                                </div>                                    

                            </div>
                            <!-- DIV COM DADOS DAS COMPETÊNCIAS A SEREM ASSOCIADAS A DISCIPLINA -->
                            <div id="sub-conteudo1" class="tab">
                                <div class="cadastro-seta-associar">
                                    <input type="hidden" id="arrayOAS" name="arrayOAS" value="" />
                                    <span class="info-cadastro"><?php echo WORDING_ASSOCIATE_OA; ?>.</span><br><br>

                                    <div class="cadastro-left-column">
                                        <span class="titulo-cadastro text-left">Objetos OAS Disponíveis</span>
                                            <div class="search-cadastro">
                                                <div class="search">
                                                    <input type="text" class="search-cadastro" id="busca-competencias" placeholder="Pesquise um OA">
                                                </div>
                                                <ul id="tabela1"></ul>
                                            </div>
                                            <div onclick="modalCompetencia();"  class='botao-cadastra' style='width: 300px'><?=WORDING_REGISTER_NOVO_OA?></div>
                                    </div>

                                    <div class="cadastro-right-column">
                                        <span class="titulo-cadastro text-right">Objetos OAS Selecionados</span>
                                        <ul id="tabela2"></ul>
                                    </div>
                                </div>
                            </div>

                            <div id="sub-conteudo2" class="tab">
                                <div class="control-group">
                                </div>
                            </div>
                            <input id="finisher" style="display: none;" type="submit" name="registrar_nova_competencia" value="<?php echo WORDING_CREATE_COMPETENCA; ?>" />
                            <ul class="pager wizard">
                                <li class="next" style="float:right"><div id="buttonNext" class='button-next text-left' onclick="mudaTab(1)"><a href="javascript:;">Próximo</a></div></li>
                                <li class="previous" style="float:none; display: none;" id="buttonPrevious" onclick="mudaTab(3)"><div class="text-right button-voltar"><a href="javascript:;">Voltar</a></div></li>
                            </ul>

                        </div>  
                    </div>
                    <br /><br />

                    <!--<input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />-->

                </form>
            </div>
            <div class="fundoPreto" style="top: 0px;"></div>
        <!--</div>-->

<!--<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>-->
<?php// include('_footer.php'); ?>