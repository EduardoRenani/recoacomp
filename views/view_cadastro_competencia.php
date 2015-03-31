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

<style type="text/css">
    body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}

ol.example li.placeholder {
  position: relative;
  /** More li styles **/
}
ol.example li.placeholder:before {
  position: absolute;
  /** Define arrowhead **/
}

</style>


<!-- Script de configuração -->



<script type="text/javascript">
    $(function() {
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            update: function(event, ui) {
            var arrayOAS = $("#tabela2").sortable('toArray').toString();
            document.getElementById('arrayOAS').value = arrayOAS;
            //var order = $('#tabela1').sortable('serialize'); 
            //$("#tabela1").load("process-sortable.php?"+order); 
            }
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
            return true;
        }
        });     
});

</script>
</head>
<!-- clean separation of HTML and PHP -->
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
                <li><a href="#tab3" data-toggle="tab"><?php echo 'Preenchimento CHA'; ?></a></li>
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
                      <ul id="tabela1">
                          <?php
                          $OA = new OA();
                          $idOA = $OA->getArrayOfId_OA();
                          $nomeOA = $OA->getArrayOfName_OA(); 
                          $contador = count($nomeOA);
                          // $idOA[$i] = posição no vetor
                          // ["idcesta"] = parametro do banco de dados
                          for($i=0;$i<$contador;$i++){ ?>
                              <li id="<?php echo "".($idOA[$i]["idcesta"]); ?>" class="ui-state-default"><?php echo "".($nomeOA[$i]["nome"]); ?></li>
                          <?php } ?>
                      </ul>
                      <ul id="tabela2">
                      <!-- Os objetos que serão associados estarão nessa tabela -->
                      </ul>
                     <a href="cadastro_OA.php" target="_blank"><?=WORDING_REGISTER_NOVO_OA?></a>

                </div>                
                <!-- Preenchimento de CHA no cadastro de competência -->
                <div class="tab-pane" id="tab3">
                    <div class="control-group">
                        <label class="control-label" for="conhecimentoDescricao"><?php echo WORDING_CONHECIMENTO_DESCRICAO; ?></label>
                        <div class="controls">
                            <textarea name="conhecimentoDescricao" Rows="5" COLS="40"></textarea>
                        </div>
                    </div>

                </div>
                <ul class="pager wizard">
                    <li class="previous"><a href="javascript:;">Anterior</a></li>
                    <li class="next"><a href="javascript:;">Próximo</a></li>
                </ul>

            </div>  
        </div>
        <br /><br />

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form>


<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
<?php include('_footer.php'); ?>