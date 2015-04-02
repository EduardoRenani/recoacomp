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
    <link href="css/base_cadastro.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">

    <style>
  .tooltip {
    display: block;
    position: absolute;
    border: 1px solid #D9D9D9;
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
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            receive : function (event, ui)
            {
       
        //         $("#tabela2").html("<option value='text'>text</option>");
           },
            update: function(event, ui) {
                var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
                var nomesCompetencias = $("#tabela2").sortable('toArray',{ attribute: "name" } ).toString();
                //window.alert(nomesCompetencias);
                document.getElementById('nomesCompetencias').innerHTML = '<strong>' + nomesCompetencias + '</strong> <div id="exemplo"></div> <div id="value"></div>';
                document.getElementById('arrayCompetencias').value = arrayCompetencias;
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
            if(!$('#nomeCurso').val()) {
                $().toastmessage('showToast', {
                    text     : nome, // Mensagem está nas variáveis
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#nomeCurso').focus();
                return false;
            }
            // Verificar se o nome da disciplina foi preenchido
            if(!$('#nomeDisciplina').valid()) {
                $().toastmessage('showToast', {
                    text     : nomeDisciplina,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#nomeDisciplina').focus();
                return false;
            }
            // Verificar se a palavra chave foi preenchida
            if(!$('#senha').valid()) {
                $().toastmessage('showToast', {
                    text     : senha,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#senha').focus();
                return false;
            }
            // Verificar se a descrição foi preenchida
            if(!$('#descricao').val()) {
                $().toastmessage('showToast', {
                    text     : descricao,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#descricao').focus();
                return false;
            }
        }

        // Preenchimento do CHA das competências
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

<div class="cadastrobase">
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_REGISTER_NOVA_DISCIPLINA); ?></div><div class="text-right" ><a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a></div></div>
        <div class="cadastrobase-content">
           <form method="post" action="" name="registrar_nova_disciplina" id="registrar_nova_disciplina">
            <!-- ID do usuário passado via hidden POST -->
            <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
                <div id="rootwizard">


                    <div class="navbar">
                      <div class="navbar-inner">
                        <div class="container">
                            <ul>
                                <li><a href="#tab1" data-toggle="tab"><?php echo WORDING_GENERAL_INFORMATION; ?></a></li>
                                <li><a href="#tab2" data-toggle="tab"><?php echo WORDING_COMPETENCIA; ?></a></li>
                                <li><a href="#tab3" data-toggle="tab"><?php echo WORDING_CHA; ?></a></li>
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
                                <label class="control-label" for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
                                <div class="controls">
                                    <input type="text" id="nomeCurso" name="nomeCurso" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
                                <div class="controls">
                                    <input type="text" id="nomeDisciplina" name="nomeDisciplina" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
                                <div class="controls">
                                    <input type="text" id="senha" name="senha" class="required">       
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
                                    <div class="controls">
                                        <textarea name="descricao" id="descricao" ROWS="5" COLS="40" class="required"></textarea>
                                    </div>
                            </div>
                        </div>


                        <!-- DIV COM DADOS DAS COMPETÊNCIAS A SEREM ASSOCIADAS A DISCIPLINA -->
                        <div class="tab-pane" id="tab2">
                            <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
                            <span style="text-align:left">Competencias Disponíveis</span><span style="float:right">Competencias Selecionadas</span>
                            <ul id="tabela1">
                                <?php
                                $comp = new Competencia();
                                $idCompetencia = $comp->getArrayOfIDs();
                                $nomeCompetencia = $comp->getArrayOfNames();
                                $contador = count($nomeCompetencia);
                                for($i=0;$i<$contador;$i++){ ?>
                                    <li id="<?php echo "".($idCompetencia[$i]["idcompetencia"]); ?>" name="<?php echo "".($nomeCompetencia[$i]["nome"]);  ?>" class="ui-state-default"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></li>
                                <?php } ?>
                            </ul>

                            
                            <ul id="tabela2">
                            <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
                            </ul>
                             
                    

                    <div class='button'><a href="cadastro_OA.php" target="_blank"><?=WORDING_CREATE_NEW_COMPETENCIA?></a></div>      
                        </div>
                        
        <!-- DIV COM COISA CHA -->
                        <div class="tab-pane" id="tab3">
                            <p> oi</p>
                            <div class="control-group">
                                
                                <div class="controls">
                                          
                            

                            <div id='nomesCompetencias'>
                            <div id="exemplo"></div>
<div id="value"></div>
                            </div>


                                </div>
                                                        </div>
                        </div>

                        <ul class="pager wizard">
                            <input id="finisher" style="display: none;" type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
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



<?php include('_footer.php'); ?>