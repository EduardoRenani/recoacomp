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
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/base_cadastro.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">
    <link href="css/landing-page.css" rel="stylesheet">
    <script src="js/jquery-customselect.js"></script>
    <link href="css/jquery-customselect.css" rel="stylesheet" />

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
    <script src="js/tooltip.js" type="text/javascript"></script>
    <script src="js/jquery.select-hierarchy.js" type="text/javascript"></script>
   

    <!-- FUNÇÃO QUE FAZ O SORTABLE E ENVIA OS ID'S DAS COMPETÊNCIAS-->
    <script>


    $(document).ready(function (){
        $('select.drilldown').selectHierarchy({ hideOriginal: true });
        $("#area_conhecimento").customselect();
    });

    $(function(){
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


    //Função que adiciona as competências de forma dinâmica na parte de preencher o CHA
    $(function() {
        $('#tabela2').sortable({
            connectWith: "#tabela1, #tabela1",
            receive : function (event, ui) {

                $(".mensagemTooltipSortable").remove();
                AjaxCompetenciaListas();
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                listaConhecimentos = document.getElementById('listaConhecimentos').value;
                listaConhecimentos = listaConhecimentos.split("¬");
                console.log(listaConhecimentos);
                console.log('oioioi');
                listaHabilidades = document.getElementById('listaHabilidades').value;
                listaHabilidades = listaHabilidades.split("¬");
                console.log(listaHabilidades);
                console.log('oioi');
                listaAtitudes = document.getElementById('listaAtitudes').value;
                listaAtitudes = listaAtitudes.split("¬");
                console.log(listaAtitudes);
                console.log('oi');
                document.getElementById('sub-conteudo2').innerHTML = '<div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0."<br>".HINT_CHA_1."<br>".HINT_CHA_2."<br>".HINT_CHA_3."<br>".HINT_CHA_4;?></div>';
                for (i = 0; i < nomesCompetencias.length; i++) {
                            listaConhecimentos[i] = encodeURI(listaConhecimentos[i]);
                            listaConhecimentos[i] = listaConhecimentos[i].replace(/%0D%0A/g, ' ');
                            listaConhecimentos[i] = decodeURI(listaConhecimentos[i]);
                            listaHabilidades[i] = encodeURI(listaHabilidades[i]);
                            listaHabilidades[i] = listaHabilidades[i].replace(/%0D%0A/g, ' ');
                            listaHabilidades[i] = decodeURI(listaHabilidades[i]);
                            listaAtitudes[i] = encodeURI(listaAtitudes[i]);
                            listaAtitudes[i] = listaAtitudes[i].replace(/%0D%0A/g, ' ');
                            listaAtitudes[i] = decodeURI(listaAtitudes[i]);
                    var elementoAdd = document.createElement('div');
                    //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                        elementoAdd.innerHTML = '<hr class="competencia-dividor"><div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div class="cha-escolha"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                        document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                $(".mensagemTooltipSortable").remove();
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayCompetencias').value = arrayCompetencias+",";
            }
        });
    });

    $(function() {
        $('#tabela1').sortable({
            connectWith: "#tabela1, #tabela2",
            receive : function (event, ui)
            {

                $(".mensagemTooltipSortable").remove();
                AjaxCompetenciaListas();
                
                $("#tabela1").sortable('refreshPositions');
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                listaConhecimentos = document.getElementById('listaConhecimentos').value;
                listaConhecimentos = listaConhecimentos.split("¬");
                listaHabilidades = document.getElementById('listaHabilidades').value;
                listaHabilidades = listaHabilidades.split("¬");
                listaAtitudes = document.getElementById('listaAtitudes').value;
                listaAtitudes = listaAtitudes.split("¬");
                console.log(listaConhecimentos);
                console.log(listaHabilidades);
                console.log(listaAtitudes);
                document.getElementById('sub-conteudo2').innerHTML = '<div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0."<br>".HINT_CHA_1."<br>".HINT_CHA_2."<br>".HINT_CHA_3."<br>".HINT_CHA_4;?></div>';
                for (i = 0; i < nomesCompetencias.length; i++) {
                            listaConhecimentos[i] = encodeURI(listaConhecimentos[i]);
                            listaConhecimentos[i] = listaConhecimentos[i].replace(/%0D%0A/g, ' ');
                            listaConhecimentos[i] = decodeURI(listaConhecimentos[i]);
                            listaHabilidades[i] = encodeURI(listaHabilidades[i]);
                            listaHabilidades[i] = listaHabilidades[i].replace(/%0D%0A/g, ' ');
                            listaHabilidades[i] = decodeURI(listaHabilidades[i]);
                            listaAtitudes[i] = encodeURI(listaAtitudes[i]);
                            listaAtitudes[i] = listaAtitudes[i].replace(/%0D%0A/g, ' ');
                            listaAtitudes[i] = decodeURI(listaAtitudes[i]);
                    var elementoAdd = document.createElement('div');
                    //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div class="cha-escolha"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                $(".mensagemTooltipSortable").remove();
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                //window.alert(nomesCompetencias);

                document.getElementById('arrayCompetencias').value = arrayCompetencias;
            }
        });
    });



</script>
</head>

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

//Enviar o ajax/Realizar a requisição

$(function(){fazAjax()});
$(window).blur(function(){fazAjax();});
$(window).focus(function(){fazAjax();});
$(window).mouseup(function(){

    fazAjax();
});

function AjaxCompetenciaListas(){
    var meu_ajax = new XMLHttpRequest();

    //Declara um "conteiner" de dados para serem enviados por POST
    var formData = new FormData();
    var listaExclusao = document.getElementById('arrayCompetencias').value;
    //Adiciona uma variável ao "contêiner", no caso, a variável 'variavel' que contém o dado 'dado'
    formData.append( 'listaExclusao', listaExclusao ); //$_POST['variavel'] === 'dado
    //Configuração do ajax: qual o "tipo" (no caso, POST) e qual a página que será acessada (no caso, ajax_page.php)
    //( o último parâmetro, um booleano, é para especificar se é assíncrono (true) ou síncrono (false) )
    meu_ajax.open( 'POST', './listasCompetencias.php', true );

    //Configurar a função que será chamada quando a requisição mudar de estado

    meu_ajax.onreadystatechange = function () {
        if ( meu_ajax.readyState === 4 ) { //readyState === 4: terminou/completou a requisição
            if ( meu_ajax.status === 200 ) { //status === 200: sucesso
                if ( meu_ajax.responseText.length > 0 ) {
                    valueListas = encodeURI(meu_ajax.responseText);
                    valueListas = valueListas.replace("%0D%0A", "");
                    valueListas = decodeURI(valueListas);
                    console.log(valueListas);
                    valueListas = valueListas.split("§");
                    console.log(valueListas);
                    document.getElementById('listaConhecimentos').value = valueListas[0];
                    document.getElementById('listaHabilidades').value = valueListas[1];
                    document.getElementById('listaAtitudes').value = valueListas[2];
                    var idCompetencias = $("#tabela2").sortable('toArray').toString();
                    var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                    idCompetencias = idCompetencias.split(",");
                    nomesCompetencias = nomesCompetencias.split(",");
                    listaConhecimentos = document.getElementById('listaConhecimentos').value;
                    listaConhecimentos = listaConhecimentos.split("¬");
                    console.log(listaConhecimentos);
                    console.log('oioioi');
                    listaHabilidades = document.getElementById('listaHabilidades').value;
                    listaHabilidades = listaHabilidades.split("¬");
                    console.log(listaHabilidades);
                    console.log('oioi');
                    listaAtitudes = document.getElementById('listaAtitudes').value;
                    listaAtitudes = listaAtitudes.split("¬");
                    // Delton - Teste para verificar se a lista de atitude está sendo preenchida
                    console.log('Lista Atitudes [');
                    console.log(listaAtitudes);
                    console.log(']');
                    console.log('oi');
                    document.getElementById('sub-conteudo2').innerHTML = '<div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0."<br>".HINT_CHA_1."<br>".HINT_CHA_2."<br>".HINT_CHA_3."<br>".HINT_CHA_4;?></div>';
                    for (i = 0; i < nomesCompetencias.length; i++) {
                            listaConhecimentos[i] = encodeURI(listaConhecimentos[i]);
                            listaConhecimentos[i] = listaConhecimentos[i].replace(/%0D%0A/g, ' ');
                            listaConhecimentos[i] = decodeURI(listaConhecimentos[i]);
                            listaHabilidades[i] = encodeURI(listaHabilidades[i]);
                            listaHabilidades[i] = listaHabilidades[i].replace(/%0D%0A/g, ' ');
                            listaHabilidades[i] = decodeURI(listaHabilidades[i]);
                            listaAtitudes[i] = encodeURI(listaAtitudes[i]);
                            listaAtitudes[i] = listaAtitudes[i].replace(/%0D%0A/g, ' ');
                            listaAtitudes[i] = decodeURI(listaAtitudes[i]);
                        var elementoAdd = document.createElement('div');
                        //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                            elementoAdd.innerHTML = '<div id="nomesCompetencias"><hr class="competencia-dividor"><h2>'+nomesCompetencias[i]+'</h2><div class="cha-escolha"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
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

//Enviar o ajax/Realizar a requisição

$(function(){
    AjaxCompetenciaListas()
});

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
                document.getElementById('buttonPrevious').removeAttribute('class');
                document.getElementById('buttonPrevious').setAttribute('class', 'previous');
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
                //document.getElementById('finisher').removeAttribute('style');
                document.getElementById('buttonNext').removeAttribute('style');
                //document.getElementById('buttonNext').setAttribute('style', 'float: none; display: none;');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(4)');
                input = '<input id="finisher" class="info-cadastro" type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />';
                document.getElementById('buttonNext').innerHTML = input;
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
            document.getElementById('buttonPrevious').removeAttribute('class');
            document.getElementById('buttonPrevious').setAttribute('class', 'previous hide');

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
            div = '<a href="javascript:;" class="button-next text-left">Próximo</a>';
            document.getElementById('buttonNext').innerHTML = div;
            //document.getElementById('finisher').setAttribute('style', 'float: none; display: none;');

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
            tAtualizaCompetencia = setInterval('atualizaCompetencia()', 1);
        }
    }

    function deleteModal() {
        if(document.getElementById('modal-competencia')) {
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
        modal.setAttribute("src", "modal_cadastro_competencia.php");
        modal.setAttribute("id", "modal-competencia");
        modal.setAttribute("style", "position: absolute; z-index: 9998; top: 10%; left: 2.5%; background-color: #fff; width: 95%; height: 980px; overflow: hidden; opacity: 0; -webkit-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; -moz-box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; box-shadow: rgba(0, 0, 0, 0.5) 0px 0px 10px 5px; margin-bottom: 50px;");
        modal.setAttribute("frameborder", "0");

        document.getElementsByClassName('cadastrobase')[0].appendChild(modal);
        document.getElementsByClassName('cadastrobase')[0].appendChild(modalClose);
        fadeInModal();
        tDeleteModal = setInterval("deleteModal()", 1);
        tPegaCompetencia = setInterval("pegaCompetencia()", 1);
    }



    function pegaCompetencia() {
        if(document.getElementById('modal-competencia')) {
            if(document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada')) {
                        idCompetencia = document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada').value;
                        //cloneOA = document.getElementById('tabela1').getElementById(idOA).cloneNode();
                        //document.getElementById('tabela2').apendChild(cloneOA);
                        document.getElementById('arrayCompetencias').value += idCompetencia+",";
                        clearInterval(window.tPegaCompetencia);
                        AjaxCompetenciaListas();
                }
        }
    }

    function atualizaCompetencia() {
        novoCompetencia = document.getElementById('arrayCompetencias').value;
        novoCompetencia = novoCompetencia.split(',');
        sizeCompetencia = novoCompetencia.length-2;
        if(document.getElementById(novoCompetencia[sizeCompetencia])) {
            if(cloneCompetencia = document.getElementById(novoCompetencia[sizeCompetencia]).cloneNode(true)) {
                document.getElementById(novoCompetencia[sizeCompetencia]).parentNode.removeChild(document.getElementById(novoCompetencia[sizeCompetencia]).parentNode.lastChild)
                document.getElementById('tabela2').appendChild(cloneCompetencia);
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                listaConhecimentos = document.getElementById('listaConhecimentos').value;
                listaConhecimentos = listaConhecimentos.split("¬");
                console.log(listaConhecimentos);
                console.log('oioioi');
                listaHabilidades = document.getElementById('listaHabilidades').value;
                listaHabilidades = listaHabilidades.split("¬");
                console.log(listaHabilidades);
                console.log('oioi');
                listaAtitudes = document.getElementById('listaAtitudes').value;
                listaAtitudes = listaAtitudes.split("¬");
                console.log(listaAtitudes);
                console.log('oi');
                document.getElementById('sub-conteudo2').innerHTML = '<div><div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0."<br>".HINT_CHA_1."<br>".HINT_CHA_2."<br>".HINT_CHA_3."<br>".HINT_CHA_4;?></div></div>';
                for (i = 0; i < nomesCompetencias.length; i++) {
                            listaConhecimentos[i] = encodeURI(listaConhecimentos[i]);
                            listaConhecimentos[i] = listaConhecimentos[i].replace(/%0D%0A/g, ' ');
                            listaConhecimentos[i] = decodeURI(listaConhecimentos[i]);
                            listaHabilidades[i] = encodeURI(listaHabilidades[i]);
                            listaHabilidades[i] = listaHabilidades[i].replace(/%0D%0A/g, ' ');
                            listaHabilidades[i] = decodeURI(listaHabilidades[i]);
                            listaAtitudes[i] = encodeURI(listaAtitudes[i]);
                            listaAtitudes[i] = listaAtitudes[i].replace(/%0D%0A/g, ' ');
                            listaAtitudes[i] = decodeURI(listaAtitudes[i]);
                    var elementoAdd = document.createElement('div');
                    //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'!!</h2><div class="cha-escolha"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="4" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="4" value="0" name="habilidade['+idCompetencias[i]+']"></div><div class="cha-escolha"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="4" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo2').appendChild(elementoAdd);
                }
                clearInterval(window.tAtualizaCompetencia);
            }
        }
    }
</script>


<div class="fixedBackgroundGradient"></div>

<div class="cadastrobase">
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_REGISTER_NOVA_DISCIPLINA); ?></div><div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>--></div></div>
        <div class="cadastrobase-content">
           <form method="post" action="" name="registrar_nova_disciplina" id="registrar_nova_disciplina">
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
                                <label class="control-label" for="nomeCurso">
                                    <div style="float: left"><?php echo WORDING_COURSE_NAME; ?></div>
                                    <div class="tooltiploco"><div onmouseover="toolTip(1, '<?php echo 'Ex. Curso Teste'?>')" onmouseout="deleteTooltip(1)">[ ? ]</div></div></label> <!-- TODO colocar variaveis mensagem tooltip -->
                                <div class="controls">
                                    <input type="text" id="nomeCurso" name="nomeCurso" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="nomeDisciplina"><div style="float: left"><?php echo WORDING_DISCIPLINA_NAME; ?></div>
                                    <div class="tooltiploco"><div onmouseover="toolTip(2, 'Ex. Disciplina Teste')" onmouseout="deleteTooltip(2)">[ ? ]</div></div></label>
                                <div class="controls">
                                    <input type="text" id="nomeDisciplina" name="nomeDisciplina" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="senha"><div style="float: left"><?php echo WORDING_REGISTRATION_PASSWORD; ?></div>
                                    <div class="tooltiploco"><div onmouseover="toolTip(3, 'Senha (mín. 6 dígitos) para os alunos cadastrarem-se na disciplina.')" onmouseout="deleteTooltip(3)">[ ? ]</div></div></label>
                                <div class="controls">
                                    <input type="text" id="senha" name="senha" class="required">       
                                </div>
                            </div>
                            <!-- Área de conhecimento-->
                            <?php 
                            $OA = new OA();
                            $OA = $OA->getAreasConhecimento();
                            ?>

                            <div class="control-group">
                                <label class="control-label" for="descricao"><div style="float: left"><?php echo WORDING_KNOWLEDGE_AREA; ?></div><div class="tooltiploco"></label><div onmouseover="toolTip(4, '<?php echo HINT_KNOWLEDGE_AREA ?>')" onmouseout="deleteTooltip(4)">?</div></div>
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

                            <!-- Descrição-->
                            <div class="control-group">
                                <label class="control-label" for="descricao"><div style="float: left"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></div><div class="tooltiploco">
                                    <div onmouseover="toolTip(5, 'Exposição do tema abordado pelo objeto e seus objetivo.')" onmouseout="deleteTooltip(5)">[ ? ]</div></div></label>
                                    <div class="controls">
                                        <textarea name="descricao" id="descricao" ROWS="5" COLS="40" class="required"></textarea>
                                    </div>
                            </div>
                        </div>


                        <!-- DIV COM DADOS DAS COMPETÊNCIAS A SEREM ASSOCIADAS A DISCIPLINA -->
                        <div id="sub-conteudo1" class="tab">
                            <div class="cadastro-seta-associar">
                                <?php 
                                // Teste para preencher o CHA
                                $competencia = new Competencia();
                                $descricaoConhecimento = $competencia-> getDescricaoConhecimento();
                                $descricaoHabilidade = $competencia-> getDescricaoHabilidade();
                                $descricaoAtitude = $competencia-> getDescricaoAtitude();
                                //print_r($descricaoConhecimento); 
                                ?>
                                <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
                                <input type="hidden" id="listaConhecimentos" name="listaConhecimentos" value="" />
                                <input type="hidden" id="listaHabilidades" name="listaHabilidades" value="" />
                                <input type="hidden" id="listaAtitudes" name="listaAtitudes" value="" />
                                <span class="info-cadastro"><?php echo WORDING_ASSOCIATE_COMP; ?></span></br></br>
                                <div class="cadastro-conteudo">
                                    <div class="cadastro-left-column">
                                        <span class="titulo-cadastro">Competencias Disponíveis</span>
                                        <div class="search-cadastro">
                                            <div class="search">
                                                  <input type="text" class="search-cadastro" id="busca-competencias" placeholder="Pesquise uma competência">
                                            </div>
                                            <ul id="tabela1">
                                            </ul>
                                        </div>
                                        <center><div onclick="modalCompetencia();" class='botao-cadastra' style='width: 250px'><?=WORDING_CREATE_NEW_COMPETENCIA?></div></center>
                                    </div>

                                    <div class=""></div>

                                    <div class="cadastro-right-column">
                                        <span class="titulo-cadastro text-right">Competencias Selecionadas</span>
                                        <ul id="tabela2">
                                        <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
                                        </ul>
                                    </div>
                                </div>
                                 
                                
                                <br>
                            </div>
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
                        
                            
                        <ul class="pager wizard">
                            <li class="next" style="float:none"><div id="buttonNext" class='button' onclick="mudaTab(1)"><a href="javascript:;" class='button-next text-left'>Próximo</a></div></li>
                            <li class="previous hide" id="buttonPrevious" onclick="mudaTab(3)"><div class="text-right button-voltar"><a href="javascript:;">Voltar</a></div></li>
                        </ul>


                    </div>  
                </div>
                <br /><br />

                
                <!--<input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />-->

            </form>
        </div>
</div>


<div class="fundoPreto"></div>
<!-- style="background-color: rgba(0, 0, 0, 0.8); height: 100%; width: 100%; position: fixed; top: 55px; left: 0px;"-->

<?php include('_footer.php'); ?>