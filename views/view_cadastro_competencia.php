<?php
/**
 * Created by PhpStorm.
 * User: Delton Vaz
 * Date: 24/03/2015
 * Time: 17:50
 */
include('_header.php'); ?>
<!-- ARRUMAR AS VALIDAÇÕES -->

<head>

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
                    elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Conhecimento</h4><input type="number" min="0" max="5" value="0" vname="conhecimento['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Habilidade</h4><input type="number" min="0" max="5" value="0" name="habilidade['+idCompetencias[i]+']"></div><div style="position: relative; float: left; width: 32%; margin-right: 1%;"><h4>Atitude</h4><input type="number" min="0" max="5" value="0" name="atitude['+idCompetencias[i]+']"></div></div>';
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

   $(function() {
    // Mensagens
    var senha = "<?php echo WORDING_FILL_PASSWORD; ?>";
    var descricao = "<?php echo WORDING_FILL_DESCRIPTION; ?>";
    var nome = "<?php echo WORDING_FILL_NAME; ?>";
    var nomeDisciplina = "<?php echo WORDING_FILL_NAME_DISCIPLINA; ?>";
    var url = "<?php echo WORDING_FILL_URL; ?>";
    var palavrachave = "<?php echo WORDING_FILL_KEYWORD; ?>";
    var data = "<?php echo WORDING_FILL_DATE; ?>";
    var descricao_educacional = "<?php echo WORDING_FILL_EDUCACIONAL_DESCRIPTION; ?>";


    $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {
    // Categoria geral
        if(index==1) {
            // Verifica se o nome foi preenchido caso contrário dá um aviso
            if(!$('#nome').val()) {
                $().toastmessage('showToast', {
                    text     : nome, // Mensagem está nas variáveis
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#nome').focus();
                return false;
            }
        }
        // Associação dos OA a competência
        if(index==2) {
       // Make sure we entered the date
            if(!$('#date').val()) {
                $().toastmessage('showToast', {
                    text     : data,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#date').focus();
                return false;
            }
        }
        }, onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $('#rootwizard').find('.pager .next').hide();
                $('#finisher').fadeIn("slow");
    
            } else {
                $('#rootwizard').find('.pager .next').show();
                $('#rootwizard').find('.pager .finish').hide();
            }
        }, onTabClick: function(tab, navigation, index) {
            if(index!=5) {
                $('#finisher').fadeOut("slow");
            }
            return true;
        }
        });     
});

</script>
</head>
<script language="javascript">
    function mudaTab(qualTab) {
        if(qualTab == 1) {
            if(document.getElementsByName('nome')[0].value.length > 0 && document.getElementsByName('descricaoNome')[0].value.length > 0 && document.getElementsByName('conhecimentoDescricao')[0].value.length > 0 && document.getElementsByName('habilidadeDescricao')[0].value.length > 0 && document.getElementsByName('atitudeDescricao')[0].value.length > 0) {
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
                    document.getElementsByName('conhecimentoDescricao')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('conhecimentoDescricao')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('conhecimentoDescricao')[0].style.border = "0";
                }
                if(document.getElementsByName('habilidadeDescricao')[0].value.length == 0) {
                    document.getElementsByName('habilidadeDescricao')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('habilidadeDescricao')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('habilidadeDescricao')[0].style.border = "0";
                }
                if(document.getElementsByName('atitudeDescricao')[0].value.length == 0) {
                    document.getElementsByName('atitudeDescricao')[0].style.border = "1px solid #dc8810";
                    document.getElementsByName('atitudeDescricao')[0].setAttribute("placeholder", "Este campo é necessário");
                }
                else {
                    document.getElementsByName('atitudeDescricao')[0].style.border = "0";
                }
            }
        }+
        else if(qualTab == 2) {
            if(document.getElementsByName('arrayOAS')[0].value.length > 0) {
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
        div1.style.zIndex = 9999;
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

<div class="fixedBackgroundGradient"></div>
<!-- clean separation of HTML and PHP -->

<div class="cadastrobase clearfix" >
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_CREATE_COMPETENCA); ?></div><div class="text-right" ><a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a></div></div>
        <div class="cadastrobase-content">
            <form method="post" action="" name="registrar_nova_competencia" id="registrar_nova_competencia">
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
                                    <label class="control-label" for="nome"><?php echo WORDING_NAME; ?></label>
                                    <div class="controls">
                                        <input type="text" id="nome" name="nome" class="required">       
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="descricaoNome"><?php echo WORDING_COMPETENCIA_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="descricaoNome" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="conhecimentoDescricao"><?php echo WORDING_CONHECIMENTO_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="conhecimentoDescricao" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="habilidadeDescricao"><?php echo WORDING_HABILIDADE_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="habilidadeDescricao" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>  
                                <div class="control-group">
                                    <label class="control-label" for="atitudeDescricao"><?php echo WORDING_ATITUDE_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="atitudeDescricao" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>                                      

                            </div>
                            <!-- DIV COM DADOS DAS COMPETÊNCIAS A SEREM ASSOCIADAS A DISCIPLINA -->
                            <div id="sub-conteudo1" class="tab">
                                <input type="hidden" id="arrayOAS" name="arrayOAS" value="" />
                                  <span style="display block; width: 40%; float: left; text-align:left;">Objetos OAS Disponíveis</span><span style="display: block; width: 30%; float: right; text-align:right;">Objetos OAS Selecionados</span>
                            <ul id="tabela1">
                                      <?php
                                      $OA = new OA();
                                      $idOA = $OA->getArrayOfId_OA();
                                      $nomeOA = $OA->getArrayOfName_OA(); 
                                      $contador = count($nomeOA);
                                      // $idOA[$i] = posição no vetor
                                      // ["idcesta"] = parametro do banco de dados
                                      for($i=0;$i<$contador;$i++){ ?>
                                          <li id="<?php echo "".($idOA[$i]["idcesta"]); ?>"name="<?php echo "".($nomeOA[$i]["nome"]); ?>" class="ui-state-default"><?php echo "".($nomeOA[$i]["nome"]); ?></li>
                                      <?php } ?>
                                  </ul>
                                  <ul id="tabela2">
                                  <!-- Os objetos que serão associados estarão nessa tabela -->
                                  </ul>
                                  <center><a href="cadastro_competencia.php" target="_blank"><div class='botao-cadastra' style='width: 240px'><?=WORDING_REGISTER_NOVO_OA?></div></a></center>

                            </div>
                            <div id="sub-conteudo2" class="tab">
                                <div class="control-group">
                                </div>
                            </div>
                            <input id="finisher" style="display: none;" type="submit" name="registrar_nova_competencia" value="<?php echo WORDING_CREATE_COMPETENCA; ?>" />
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

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
<?php include('_footer.php'); ?>