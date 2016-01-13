    <?php
    /**
     * Created by PhpStorm.
     * User: Delton Vaz
     * Date: 14/01/2015
     * Time: 17:36
     */

    include('_header.php');?>

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
        <link href="css/base_cadastro_objeto.css" rel="stylesheet">
        <link href="css/tooltip.css" rel="stylesheet">
        <link href="css/base_cadastro.css" rel="stylesheet">
        <link href="css/progress_cadastro_OA_breadcrumb.css" rel="stylesheet">


        <script src="js/jquery-customselect.js"></script>

        <link href="css/jquery-customselect.css" rel="stylesheet" />
        <!-- Estava no Header-->
        
        
        <style>
        body { font-size: 62.5%; }
        label, input { display:block; width: 100%; }
        input.text { margin-bottom:12px; width:95%; padding: .4em; }
        fieldset { padding:0; border:0; margin-top:25px; }
        h1 { font-size: 1.2em; margin: .6em 0; }
        div#users-contain { width: 350px; margin: 20px 0; }
        div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
        div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
        .ui-dialog .ui-state-error { padding: .3em; }
        .validateTips { border: 1px solid transparent; padding: 0.3em; }
        .object_ok { border: 1px solid green; color: #333333; }
        .object_error { border: 1px solid #AC3962; color: #333333; }
 

        </style>

        <!-- BREADCRUMB BONITO-->
        <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>
        <script src="js/tooltip.js" type="text/javascript"></script>



    <!-- clean separation of HTML and PHP -->
    <script>
        $(function() {
          $("#area_conhecimento").customselect();
        });
    </script>


    <script>

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
                    $( ".mensagemTooltiploco" ).remove();
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
                    document.getElementById('sub-conteudo6').innerHTML = '<div class="info-cadastro"><?php echo TEXT_CHA;?> <?php echo HINT_CHA;?></div>';
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
                    console.log("hahaha");
                    console.log(listaHabilidades[i+1]);
                    //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                        elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                        document.getElementById('sub-conteudo6').appendChild(elementoAdd);
                    }
            //         $("#tabela2").html("<option value='text'>text</option>");
               },
                update: function(event, ui) {
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
                    $( ".mensagemTooltipSortable" ).remove();
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
                    document.getElementById('sub-conteudo6').innerHTML = '<div class="info-cadastro"><?php echo TEXT_CHA;?> <?php echo HINT_CHA;?></div>';
                    console.log(nomesCompetencias.length);
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
                            //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                        elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                        document.getElementById('sub-conteudo6').appendChild(elementoAdd);
                        }
                    
            //         $("#tabela2").html("<option value='text'>text</option>");
               },
                update: function(event, ui) {
                    $( ".mensagemTooltipSortable" ).remove();
                    var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                    //window.alert(nomesCompetencias);

                    document.getElementById('arrayCompetencias').value = arrayCompetencias+",";
                }
            });
        });
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
                    console.log(listaAtitudes);
                    console.log('oi');
                    document.getElementById('sub-conteudo6').innerHTML = '<div class="info-cadastro"><?php echo TEXT_CHA;?> <?php echo HINT_CHA;?></div>';
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
                        //elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'" >?</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div class="tooltiploco"><div id="'+idCompetencias[i]+'">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                        
                        var elementoAdd = document.createElement('div');
                                            elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                                            document.getElementById('sub-conteudo6').appendChild(elementoAdd);
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

$(function(){AjaxCompetenciaListas()});
</script>

    <script language="javascript">
        function mudaTab(qualTab) {
            if(qualTab == 1) {
                if(document.getElementsByName('nome')[0].value.length > 0 && document.getElementsByName('palavrachave')[0].value.length > 0 && document.getElementsByName('idioma')[0].value.length > 0 && document.getElementsByName('descricao')[0].value.length > 0 && (document.getElementsByName('url')[0].value != "http://" && document.getElementsByName('url')[0].value != "") && document.getElementById('area_conhecimento').value.length > 0) {
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
                    if(document.getElementById('area_conhecimento').value.length <= 0) {
                        document.getElementById('area_conhecimento').style.border = "1px solid #dc8810";
                        document.getElementById('area_conhecimento').value = "";
                        document.getElementById('area_conhecimento').setAttribute("placeholder", "Min. 6 digitos");
                    }
                    else {
                        document.getElementById('area_conhecimento').style.border = "0";
                    }
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
                if(document.getElementById('tipoOA[]').value.length > 0) {
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
                    document.getElementById('seta4').removeAttribute('class');
                    document.getElementById('seta4').setAttribute('class', 'seta-active');
                    document.getElementById('buttonNext').removeAttribute('onclick');
                    document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(4)');
                    document.getElementById('buttonPrevious').removeAttribute('onclick');
                    document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(9)');
                }

            }
            else if(qualTab == 4) {
                if(document.getElementsByName('descricao_educacional')[0].value.length > 0 && document.getElementById('faixaEtaria[]').value.length > 0) {
                    document.getElementsByName('descricao_educacional')[0].style.border = "0";
                    divTab = document.getElementById('sub-conteudo3');
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
            else if(qualTab == 6) {
                if(document.getElementsByName('arrayCompetencias')[0].value.length > 1) {
                    document.getElementById('tabela1').style.border = "0";
                    document.getElementById('tabela2').style.border = "0";
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
                else {
                    document.getElementById("sub-conteudo5").getElementsByTagName('span')[1].innerHTML = "<span style='color: #dc8810'>Escolha uma competência";
                    document.getElementById("tabela1").style.border = "1px solid #dc8810";
                    document.getElementById("tabela2").style.border = "1px solid #dc8810";
                    window.scrollTo(0, 0);
                }
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
                document.getElementById('seta4').removeAttribute('class');
                document.getElementById('seta2').removeAttribute('class');
                document.getElementById('seta2').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(3)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(8)');
            }
            else if(qualTab == 11) {
                divTab = document.getElementById('sub-conteudo5');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab');
                divTab = document.getElementById('sub-conteudo3');
                divTab.removeAttribute('class');
                divTab.setAttribute('class', 'tab-active');
                document.getElementById('menudiv5').removeAttribute('class');
                document.getElementById('seta5').removeAttribute('class');
                document.getElementById('seta4').removeAttribute('class');
                document.getElementById('seta4').setAttribute('class', 'seta-active');
                document.getElementById('buttonNext').removeAttribute('onclick');
                document.getElementById('buttonNext').setAttribute('onclick', 'mudaTab(4)');
                document.getElementById('buttonPrevious').removeAttribute('onclick');
                document.getElementById('buttonPrevious').setAttribute('onclick', 'mudaTab(9)');
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
            if(document.getElementById('modal-competencia').contentDocument.getElementsByClassName('disciplinas-list')){
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
        console.log(document.getElementById('modal-competencia').contentDocument);
        if(document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada')) {
            if(document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada').length != 0) {
                idCompetencia = document.getElementById('modal-competencia').contentDocument.getElementById('competenciacadastrada').value;
                //cloneOA = document.getElementById('tabela1').getElementById(idOA).cloneNode();
                //document.getElementById('tabela2').apendChild(cloneOA);
                document.getElementById('arrayCompetencias').value += idCompetencia+',';
                clearInterval(window.tPegaCompetencia);
                AjaxCompetenciaListas();
            }
        }
    }

    function atualizaCompetencia() {
        novoCompetencia = document.getElementById('arrayCompetencias').value;
        novoCompetencia = novoCompetencia.split(',');
        sizeCompetencia = novoCompetencia.length-2;
        if(document.getElementById(novoCompetencia[novoCompetencia.length-2])) {
            if(cloneCompetencia = document.getElementById(novoCompetencia[novoCompetencia.length-2]).cloneNode(true)) {
                document.getElementById(novoCompetencia[novoCompetencia.length-2]).parentNode.removeChild(document.getElementById(novoCompetencia[novoCompetencia.length-2]).parentNode.lastChild)
                document.getElementById('tabela2').appendChild(cloneCompetencia);
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                idCompetencias = idCompetencias.split(",");
                nomesCompetencias = nomesCompetencias.split(",");
                listaConhecimentos = document.getElementById('listaConhecimentos').value;
                listaConhecimentos = listaConhecimentos.split("¬");
                console.log(listaConhecimentos);
                //console.log('oioioi');
                listaHabilidades = document.getElementById('listaHabilidades').value;
                listaHabilidades = listaHabilidades.split("¬");
                console.log(listaHabilidades);
                //console.log('oioi');
                listaAtitudes = document.getElementById('listaAtitudes').value;
                listaAtitudes = listaAtitudes.split("¬");
                console.log(listaAtitudes);
                //console.log('oi');
                document.getElementById('sub-conteudo6').innerHTML = '<div class="info-cadastro"><?php echo TEXT_CHA;?> <?php echo HINT_CHA;?></div>';
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
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><div id="conhecimento'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'conhecimento'+idCompetencias[i]+'\', \''+listaConhecimentos[i]+'\')" onmouseout="deleteTooltipComp(\'conhecimento'+idCompetencias[i]+'\')">[ ? ]</div></div><input type="number" min="0" max="5" value="0" name="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><div id="habilidade'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'habilidade'+idCompetencias[i]+'\', \''+listaHabilidades[i]+'\')" onmouseout="deleteTooltipComp(\'habilidade'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><div id="atitude'+idCompetencias[i]+'" class="tooltiploco"><div onmouseover="toolTipComp(\'atitude'+idCompetencias[i]+'\', \''+listaAtitudes[i]+'\')" onmouseout="deleteTooltipComp(\'atitude'+idCompetencias[i]+'\')">?</div></div><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
                    document.getElementById('sub-conteudo6').appendChild(elementoAdd);
                }
                clearInterval(window.tAtualizaCompetencia);
            }
        }
    }
    </script>

    <div class="fixedBackgroundGradient"></div>
    <div class="cadastrobase">
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
                <!--div id="seta3"></div-->
                <!--div id="menudiv4"><?php echo WORDING_RIGHT_CATEGORY; ?></div-->
                <div id="seta4"></div>
                <div id="menudiv5"><?php echo WORDING_ASSOCIATE_COMPETENCE; ?></div>
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
                        <label class="control-label" for="tipoOA"><?php echo WORDING_OA_TYPE; ?> (Utilizar o CTRL para selecionar mais de um)</label>
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
                        <label class="control-label" for="faixaEtaria"><?php echo WORDING_AGE_GROUP; ?> (Utilizar o CTRL para selecionar mais de um)</label>
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

                <div id="sub-conteudo5" class="tab">
                    <div class="cadastro-seta-associar">
                    <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
                    <input type="hidden" id="listaConhecimentos" name="listaConhecimentos" value="" />
                    <input type="hidden" id="listaHabilidades" name="listaHabilidades" value="" />
                    <input type="hidden" id="listaAtitudes" name="listaAtitudes" value="" />

                    <span class="info-cadastro"><?php echo WORDING_ASSOCIATE_COMP_OA; ?>.<div class="tooltiploco"><div onmouseover="toolTip(7, '<?php echo HINT_COMPETENCY ?>')" onmouseout="deleteTooltip(7)">[ ? ]</div></div></span><br><br>

                    <div class="cadastro-left-column">
                        <span class="titulo-cadastro">Competências Disponíveis</span>
                            <div class="search-cadastro">
                                <div class="search">
                                    <input type="text" class="search-cadastro" id="busca-competencias" placeholder="Pesquise uma competência">
                                </div>
                                <ul id="tabela1"></ul>
                            </div>
                            <div onclick="modalCompetencia();"  class='botao-cadastra' style='width: 240px'><?=WORDING_CREATE_NEW_COMPETENCIA?></div>
                    </div>

                    <div class="cadastro-right-column">
                        <span class="titulo-cadastro text-right">Competências Selecionadas</span>
                        <ul id="tabela2"></ul>
                    </div>
                </div>
                </div>

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
    </div>
    <div class="fundoPreto"></div>

        <!-- backlink -->
        <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

    <?php include('_footer.php');

    ?>