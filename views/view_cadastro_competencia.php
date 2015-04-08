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
var i = 0;

    $(function() {
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            receive : function (event, ui)
            {
                var idCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                var idCompetencias = idCompetencias.split(",");
                var nomesCompetencias = nomesCompetencias.split(",");
                var elementoAdd = document.createElement('div');
                elementoAdd.innerHTML = '<div id="nomesCompetencias"><h2>'+nomesCompetencias[i]+'</h2><div><h4>Conhecimento</h4></div><div><input type="number" min="0" max="5" name="conhecimento['+idCompetencias[i]+']"</div><div><h4>Habilidade</h4></div><div><input type="number" name="habilidade['+idCompetencias[i]+']"</div><div><h4>Atitude</h4></div><div><input type="number" name="atitude['+idCompetencias[i]+']"</div></div>';
                document.getElementById('tab3').appendChild(elementoAdd);
                i++;
                
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
<div class="fixedBackgroundGradient"></div>
<!-- clean separation of HTML and PHP -->

<div class="cadastrobase" >
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_CREATE_COMPETENCA); ?></div><div class="text-right" ><a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a></div></div>
        <div class="cadastrobase-content">
            <form method="post" action="" name="registrar_nova_competencia" id="registrar_nova_competencia">
                <!-- ID do usuário passado via hidden POST -->
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                    <div id="rootwizard">
                        <div class="navbar">
                          <div class="navbar-inner">
                            <div class="container">
                        <ul>
                            <li><a href="#tab1" data-toggle="tab"><?php echo WORDING_CREATE_COMPETENCA; ?></a></li>
                            <li><a href="#tab2" data-toggle="tab"><?php echo 'Associar OAS'; ?></a></li>
                            <li><a href="#tab3" data-toggle="tab"><?php echo 'Preencher CHA'; ?></a></li>
                        </ul>
                         </div>
                          </div>
                        </div>
                            <div id="bar" class="progress progress-striped active">
                                <div class="bar">
                                </div>
                            </div>


                        <div class="tab-content">
                            <div class="tab-pane" id="tab1">
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
                                    <label class="control-label" for="atitudeDescricao"><?php echo WORDING_ATITUDE_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="atitudeDescricao" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>                    
                                <div class="control-group">
                                    <label class="control-label" for="habilidadeDescricao"><?php echo WORDING_HABILIDADE_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="habilidadeDescricao" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>                    
                                <div class="control-group">
                                    <label class="control-label" for="conhecimentoDescricao"><?php echo WORDING_CONHECIMENTO_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="conhecimentoDescricao" Rows="5" COLS="40"></textarea>
                                    </div>
                                </div>

                            </div>
                            <!-- DIV COM DADOS DAS COMPETÊNCIAS A SEREM ASSOCIADAS A DISCIPLINA -->
                            <div class="tab-pane" id="tab2">
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
                                  <div class='button'><a href="cadastro_OA.php" target="_blank"><?=WORDING_REGISTER_NOVO_OA?></a></div>   
                                 <!--<a href="cadastro_OA.php" target="_blank"><?=WORDING_REGISTER_NOVO_OA?></a>-->

                            </div>
                            <div class="tab-pane" id="tab3">
                                <div class="control-group">
                                </div>
                            </div>

                            <ul class="pager wizard">
                                <input id="finisher" style="display: none;" type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_COMPETENCA; ?>" />
                                <li class="next" style="float:none"><div class='button'><a href="javascript:;" class='button-next text-left'>Próximo</a></div></li>
                                <li class="previous" style="float:none"><div class="text-right"><a href="javascript:;">Voltar</a></div></li>
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