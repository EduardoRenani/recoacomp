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
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/base_cadastro.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">

    <style>
    .tooltip {
    display: block;
    position: absolute;
    font: 400 12px/12px Arial;
    border-radius: 3px;
    background: #fff;
    top: -43px;
    padding: 5px;
    left: -9px;
    text-align: center;
    width: 50px;
    }
    .tooltip strong {
        display: block;
        padding: 2px;
    }

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

    <!-- BREADCRUMB BONITO-->
    <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
    <script src="js/jquery.nouislider.all.min.js" type="text/javascript"></script>
    <?php
    //$nomedadisciplina = $disciplinas->getNomeDisciplinaById
        $nomedadisciplina = $disciplina->getNomeDisciplinaById($_POST['disc']);
        $nomedocurso = $disciplina->getNomeCursoById($_POST['disc']);
        $senhaDisciplina = $disciplina->getSenhaDisciplinaById($_POST['disc']);
        $descricaoDisciplina = $disciplina->getDescricaoDisciplinaById($_POST['disc']);
        $idCompetencias = $disciplina->getCompetenciaFromDisciplinaById($_POST['disc']);
        foreach ($idCompetencias as $value) {
            $idCompetenciasEnviar .= $value[0].",";
            $chaCompetencias =  $disciplina->getCHAFromDisciplinaByIdCompetencia($value[0], $_POST['disc']);
            $chaCompetenciasEnviar .= $idCompetenciasEnviar;
            for($i = 0; $i < 3; $i++) {
                $chaCompetenciasEnviar .= $chaCompetencias[0][$i].",";
            }
            $chaCompetenciasEnviar .= "/";
        }
    ?>

    <!-- FUNÇÃO QUE FAZ O SORTABLE E ENVIA OS ID'S DAS COMPETÊNCIAS-->
    <script>


    $(function(){
        $("#exemplo").noUiSlider({
            start: 1,
            step: 1,
            range: {
                min: 1,
                max: 5
            }
        });
        function setText( value, handleElement, slider ){
            $("#exemplo").text( value );
        }
        $("#exemplo").Link('lower').to($("#value"), "text");

        $("#exemplo").Link('lower').to('-inline-<div class="tooltip"></div>', function ( value ) {

            // The tooltip HTML is 'this', so additional
            // markup can be inserted here.
            $(this).html(
                '<strong>Value: </strong>' +
                '<span>' + value + '</span>'
            );
        });

    });

    $(function() {
        $('#tabela2').sortable({
            connectWith: "#tabela1, #tabela1",
            receive : function (event, ui) {
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                var chaCompetencias = '<?php echo $chaCompetenciasEnviar; ?>'
                chaCompetencias = chaCompetencias.split("/");
                for(i = 0; i < chaCompetencias.length; i++) {
                    chaCompetencias[i] = chaCompetencias[i].split(",");
                }
                console.log(chaCompetencias);
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = "";
                for (i = 0; i < nomesCompetencias.length; i++) {
                	j = 0;
                    var elementoAdd = document.createElement('div');
                    if(chaCompetencias[j][0] != idCompetencias[i]) {
                    	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    }
                    else {
                    	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][1]+'" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][2]+'" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][3]+'" name="atitude['+idCompetencias[i]+']"></div></div>';
                    	j++;
                    }
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                //fazAjaxTabela2();
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayCompetencias').value = arrayCompetencias+',';
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
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                var chaCompetencias = '<?php echo $chaCompetenciasEnviar; ?>'
                chaCompetencias = chaCompetencias.split("/");
                for(i = 0; i < chaCompetencias.length; i++) {
                    chaCompetencias[i] = chaCompetencias[i].split(",");
                }
                console.log(chaCompetencias);
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                document.getElementById('sub-conteudo2').innerHTML = "";
                for (i = 0; i < nomesCompetencias.length; i++) {
                	j = 0;
                    var elementoAdd = document.createElement('div');
                    if(chaCompetencias[j][0] != idCompetencias[i]) {
                    	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    }
                    else {
                    	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][1]+'" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][2]+'" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][3]+'" name="atitude['+idCompetencias[i]+']"></div></div>';
                    	j++;
                    }
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                
                //fazAjaxTabela2();
                
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);
                if(arrayCompetencias != "") {
                	document.getElementById('arrayCompetencias').value = arrayCompetencias+',';
                }
                else {
                	document.getElementById('arrayCompetencias').value = arrayCompetencias;
                }
            }
        });
    });


    // Bootstrap wizard, mais info em http://vadimg.com/twitter-bootstrap-wizard-example/
    $(function() {
       var $validator = $("#registrar_nova_disciplina").validate({
            rules: {
                url: {
                    required: true,
                    minlength: 3,
                    url: true
                }
            }
        }); 
});
</script>
</head>

<script>
//Declara uma nova requisição ajax
function fazAjax(){
    var meu_ajax = new XMLHttpRequest();

    //Declara um "conteiner" de dados para serem enviados por POST
    var formData = new FormData();
    var listaExclusao = document.getElementById('arrayCompetencias').value;
    console.log(listaExclusao);
    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
    formData.append( 'listaExclusao', listaExclusao); //$_POST['variavel'] === 'dado
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
                    element_tabela1.innerHTML = '';
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

//Declara uma nova requisição ajax
function fazAjaxTabela2(){
    var meu_ajax = new XMLHttpRequest();

    //Declara um "conteiner" de dados para serem enviados por POST
    var formData = new FormData();
    var listaExclusao = '<?php echo $idCompetenciasEnviar; ?>';
    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
    formData.append( 'listaExclusao', listaExclusao); //$_POST['variavel'] === 'dado
    //Configuração do ajax: qual o "tipo" (no caso, POST) e qual a página que será acessada (no caso, ajax_page.php)
    //( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
    meu_ajax.open( 'POST', './competenciasAssociadas.php', true );

    //Configurar a função que será chamada quando a requisição mudar de estado

    meu_ajax.onreadystatechange = function () {
        if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
            if ( meu_ajax.status === 200 ) { //status === 200: sucesso
                if ( meu_ajax.responseText.length > 0 ) {
                    var array = JSON.parse(meu_ajax.responseText);
                    var element_tabela1 = document.getElementById('tabela2');
                    for(var i = 0; i < array.length; i++) {
                        if ( element_tabela1.innerHTML.indexOf(array[i]) === -1) {
                            element_tabela1.innerHTML += array[i];
                        }
                    }
                    document.getElementById('arrayCompetencias').value = listaExclusao;
                    fazAjax();
                    var idCompetencias = $("#tabela2").sortable('toArray').toString();
                    var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                    var chaCompetencias = '<?php echo $chaCompetenciasEnviar; ?>'
                    chaCompetencias = chaCompetencias.split("/");
                    for(i = 0; i < chaCompetencias.length; i++) {
                        chaCompetencias[i] = chaCompetencias[i].split(",");
                    }
                    console.log(chaCompetencias);
                    idCompetencias = idCompetencias.split(",");
                    nomesCompetencias = nomesCompetencias.split(",");
                    document.getElementById('sub-conteudo2').innerHTML = "";
                    for (i = 0; i < nomesCompetencias.length; i++) {
                    	j = 0;
                        var elementoAdd = document.createElement('div');
                        if(chaCompetencias[j][0] != idCompetencias[i]) {
                        	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                        }
                        else {
                        	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][1]+'" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][2]+'" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][3]+'" name="atitude['+idCompetencias[i]+']"></div></div>';
                        	j++;
                        }
                        document.getElementById('sub-conteudo2').appendChild(elementoAdd);
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
$(window).load(function(){fazAjaxTabela2();});


function fazAjaxTabela2Atualiza(){
    var meu_ajax = new XMLHttpRequest();

    //Declara um "conteiner" de dados para serem enviados por POST
    var formData = new FormData();
    var listaExclusao = document.getElementById('arrayCompetencias').value;
    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
    formData.append( 'listaExclusao', listaExclusao); //$_POST['variavel'] === 'dado
    //Configuração do ajax: qual o "tipo" (no caso, POST) e qual a página que será acessada (no caso, ajax_page.php)
    //( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
    meu_ajax.open( 'POST', './competenciasAssociadas.php', true );

    //Configurar a função que será chamada quando a requisição mudar de estado

    meu_ajax.onreadystatechange = function () {
        if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
            if ( meu_ajax.status === 200 ) { //status === 200: sucesso
                if ( meu_ajax.responseText.length > 0 ) {
                    var array = JSON.parse(meu_ajax.responseText);
                    var element_tabela1 = document.getElementById('tabela2');
                    for(var i = 0; i < array.length; i++) {
                        if ( element_tabela1.innerHTML.indexOf(array[i]) === -1) {
                            element_tabela1.innerHTML += array[i];
                        }
                    }
                    document.getElementById('arrayCompetencias').value = listaExclusao;
                    fazAjax();
                    var idCompetencias = $("#tabela2").sortable('toArray').toString();
                    var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                    var chaCompetencias = '<?php echo $chaCompetenciasEnviar; ?>'
                    chaCompetencias = chaCompetencias.split("/");
                    for(i = 0; i < chaCompetencias.length; i++) {
                        chaCompetencias[i] = chaCompetencias[i].split(",");
                    }
                    console.log(chaCompetencias);
                    idCompetencias = idCompetencias.split(",");
                    nomesCompetencias = nomesCompetencias.split(",");
                    document.getElementById('sub-conteudo2').innerHTML = "";
                    for (i = 0; i < nomesCompetencias.length; i++) {
                    	j = 0;
                        var elementoAdd = document.createElement('div');
                        if(chaCompetencias[j][0] != idCompetencias[i]) {
                        	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                        }
                        else {
                        	elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][1]+'" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][2]+'" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="'+chaCompetencias[j][3]+'" name="atitude['+idCompetencias[i]+']"></div></div>';
                        	j++;
                        }
                        document.getElementById('sub-conteudo2').appendChild(elementoAdd);
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

</script>


<script language="javascript">

    function mudaTab(qualTab) {
        if(qualTab == 1) {
            if(document.getElementsByName('senha')[0].value.length > 5 && document.getElementsByName('nomeCurso')[0].value.length > 0 && document.getElementsByName('nomeDisciplina')[0].value.length > 0 && document.getElementsByName('descricao')[0].value.length > 0) {
                document.getElementsByName('senha')[0].style.border = "0";
                document.getElementsByName('nomeCurso')[0].style.border = "0";
                document.getElementsByName('nomeDisciplina')[0].style.border = "0";
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
            }
            else {
                if(document.getElementsByName('senha')[0].value.length <= 5) {
                    document.getElementsByName('senha')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('senha')[0].value = "";
                    document.getElementsByName('senha')[0].setAttribute("placeholder", "Min. 6 digitos");
                }
                else {
                    document.getElementsByName('senha')[0].style.border = "0";
                }
                if(document.getElementsByName('nomeCurso')[0].value.length == 0) {
                    document.getElementsByName('nomeCurso')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('nomeCurso')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('nomeCurso')[0].style.border = "0";
                }
                if(document.getElementsByName('nomeDisciplina')[0].value.length == 0) {
                    document.getElementsByName('nomeDisciplina')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('nomeDisciplina')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('nomeDisciplina')[0].style.border = "0";
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
            if(document.getElementsByName('arrayCompetencias')[0].value.length > 0) {
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

    opacityModal = 0;
    function fadeInModal() {
        div = document.getElementById('modal-competencia');
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
        div = document.getElementById('modal-competencia');
        div1 = document.getElementById('closeModal');
        divFundo = document.getElementsByClassName('fundoPreto')[0];
        divFundo.style.opacity = opacityModal;
        div1.style.opacity = opacityModal;
        div.style.opacity = opacityModal;
        opacityModal-=0.01;
        tFadeOutModal = setTimeout(function() {fadeOutModal()}, 1);
        if (opacityModal <= 0) {
            divFundo.style.display = "none";
            divDelete = document.getElementById('modal-competencia');
            divDelete.parentNode.removeChild(divDelete);
            divDeleteClose = document.getElementById('closeModal');
            divDeleteClose.parentNode.removeChild(divDeleteClose);
            fazAjax();
            clearInterval(window.tDeleteModal);
            clearTimeout(tFadeOutModal);
        }
    }

    function deleteModal() {
    	if(document.getElementById('modal-competencia').contentDocument.getElementsByClassName('disciplinas-list')) {
	        if(document.getElementById('modal-competencia').contentDocument.getElementsByClassName('disciplinas-list').length != 0) {
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
        modalClose.setAttribute("style", "position: absolute; top: 12%; left: 0; font-size: 20px; background-color: ; z-index: 9999; width: 100%; padding-right: 33px;l");
        modalClose.innerHTML = '<a href="#"><span class="glyphicon glyphicon-remove"></span></a>';
        modal = document.createElement("iframe");
        modal.setAttribute("src", "modal_cadastro_competencia_oa.php");
        modal.setAttribute("id", "modal-competencia");
        modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 780px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
        modal.setAttribute("frameborder", "0");

        document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
        document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
        fadeInModal();
        tDeleteModal = setInterval("deleteModal()", 1);
        tPegaCompetencia = setInterval("pegaCompetencia()", 1);
    }



function pegaCompetencia() {
	if(document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada')) {
	    if(document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada').length != 0) {
	    	console.log("asdasdasdasdasd");
	        idCompetencia = document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada').value;
	        //cloneOA = document.getElementById('tabela1').getElementById(idOA).cloneNode();
	        //document.getElementById('tabela2').apendChild(cloneOA);
	        document.getElementById('arrayCompetencias').value += idCompetencia+',';
            atualizaCompetencia();
	        clearInterval(window.tPegaCompetencia);
	    }
	}
}

function atualizaCompetencia() {
    novoCompetencia = document.getElementById('arrayCompetencias').value;
    novoCompetencia = novoCompetencia.split(',');
    sizeCompetencia = novoCompetencia.length-1;
    fazAjaxTabela2Atualiza();
}
</script>

<div class="fixedBackgroundGradient"></div>

<div class="cadastrobase">
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_EDIT_COURSE); ?></div><div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>--></div></div>
        <div class="cadastrobase-content">
           <form method="post" action="" name="editar_disciplina" id="editar_disciplina">
            <!-- ID do usuário passado via hidden POST -->
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                <div id="rootwizard">


                    <div id="menu">
                        <div id="menudiv" class="meu-active"><?php echo WORDING_GENERAL_INFORMATION; ?></div>
                        <div id="seta" class="seta-active"></div>
                        <div id="menudiv1"><?php echo WORDING_COMPETENCIA; ?></div>
                        <div id="seta1"></div>
                        <div id="menudiv2"><?php echo WORDING_CHA; ?></div>
                    </div>
                        <div id="conteudo" class="clearfix">
                            <div id="sub-conteudo" class="tab-active">


                            <div class="control-group">
                                <label class="control-label" for="nomeCurso"><div style="float: left"><?php echo WORDING_COURSE_NAME; ?></div><div class="tooltiploco"><div onmouseover="toolTip(1, 'Ex. Curso Teste')" onmouseout="deleteTooltip(1)">?</div></div></label> <!-- TODO colcoar variaveis mensagem tooltip -->
                                <div class="controls">
                                    <input type="text" id="nomeCurso" name="nomeCurso" value="<?php echo $nomedocurso[0][0]; ?>" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="nomeDisciplina"><div style="float: left"><?php echo WORDING_DISCIPLINA_NAME; ?></div><div class="tooltiploco"><div onmouseover="toolTip(2, 'Ex. Disciplina Teste')" onmouseout="deleteTooltip(2)">?</div></div></label>
                                <div class="controls">
                                    <input type="text" id="nomeDisciplina" name="nomeDisciplina" value="<?php echo $nomedadisciplina[0][0]; ?>" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="senha"><div style="float: left"><?php echo WORDING_REGISTRATION_PASSWORD; ?></div><div class="tooltiploco"><div onmouseover="toolTip(3, 'Senha para cadastrar-se na disciplina')" onmouseout="deleteTooltip(3)">?</div></div></label>
                                <div class="controls">
                                    <input type="text" id="senha" name="senha"  value="<?php echo $senhaDisciplina[0][0]; ?>" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="descricao"><div style="float: left"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></div><div class="tooltiploco"><div onmouseover="toolTip(4, 'Ex. Curso que procura ensinar algo ao aluno')" onmouseout="deleteTooltip(4)">?</div></div></label>
                                    <div class="controls">
                                        <textarea name="descricao" id="descricao" ROWS="5" COLS="40" class="required"><?php echo $descricaoDisciplina[0][0]; ?></textarea>
                                    </div>
                            </div>
                        </div>


                        <!-- DIV COM DADOS DAS COMPETÊNCIAS A SEREM ASSOCIADAS A DISCIPLINA -->
                        <div id="sub-conteudo1" style="background-image: url(img/seta_drag.png); background-repeat: no-repeat; background-position: 49.5% 40%; background-size: 50px;" class="tab">
                            <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
                            <input type="hidden" id="idDisciplina" name="idDisciplina" value="<?php echo $_POST['disc']?>" />
                            <span style="display block; width: 100%; float: left; text-align:center;"><?php echo WORDING_ASSOCIATE_COMP_EDIT; ?></span></br></br>
                            <span style="display block; width: 40%; float: left; text-align:left;">Competencias Disponíveis</span><span style="display: block; width: 30%; float: right; text-align:right;">Competencias Selecionadas</span>
                            <ul id="tabela1">

                            </ul>

                            
                            <ul id="tabela2">
                            <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
                            </ul>
                             
                    
                    <center><div onclick="modalCompetencia();" class='botao-cadastra' style='width: 240px'><?=WORDING_CREATE_NEW_COMPETENCIA?></div></center>
                    <br>
                        </div>
                        
                    <!-- DIV COM COISA CHA -->
                        <div id="sub-conteudo2" class="tab">
                            <div class="control-group">
                                <div class="controls">                                    
                                        <div id='nomesCompetencias'>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <input id="finisher" style="display: none;" type="submit" name="editar_disciplina" value="<?php echo WORDING_EDIT_COURSE_FINAL; ?>" />
                            
                        <ul class="pager wizard">
                            <li class="next" style="float:none"><div id="buttonNext" class='button' onclick="mudaTab(1)"><a href="javascript:;" class='button-next text-left'>Próximo</a></div></li>
                            <li class="previous" style="float:none; display: none;" id="buttonPrevious" onclick="mudaTab(3)"><div class="text-right"><a href="javascript:;">Voltar</a></div></li>
                        </ul>


                    </div>  
                </div>
                <br /><br />

                
                <!--<input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />-->

            </form>
        </div>
</div>


<div class="fundoPreto"></div>
                            <!--ul id="tabela2">
                            <?php
                                $comp = new Competencia();
                                for($j = 0; $j < sizeof($idCompetencias); $j++) {
                                $idCompetencia = $comp->getArrayOfIDsById($idCompetencias[$j][0]);
                                $nomeCompetencia = $comp->getArrayOfNamesById($idCompetencias[$j][0]);
                                $contador = count($nomeCompetencia);
                                for($i=0;$i<$contador;$i++){ ?>
                                    <li id="<?php echo "".($idCompetencia[$i]["idcompetencia"]); ?>" name="<?php echo "".($nomeCompetencia[$i]["nome"]);  ?>" class="ui-state-default"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></li>
                                <?php
                                 }
                                }
                                ?>
                            </ul-->

<!-- style="background-color: rgba(0, 0, 0, 0.8); height: 100%; width: 100%; position: fixed; top: 55px; left: 0px;"-->
<?php include('_footer.php'); ?>