<?php
/**
 * Created by PhpStorm.
 * User: claus_000
 * Date: 10/09/14
 * Time: 09:33
 */

include('_header.php');
require_once("classes/OA.php");?>


<!-- clean separation of HTML and PHP -->
<script>
$(function() {

    var $validator = $("#commentForm").validate({
            rules: {
                url: {
                    required: true,
                    minlength: 3,
                    url: true
                }
            }
        });
    // Mensagens
    var descricao = "<?php echo WORDING_FILL_DESCRIPTION; ?>";
    var nome = "<?php echo WORDING_FILL_NAME; ?>";
    var url = "<?php echo WORDING_FILL_URL; ?>";
    var palavrachave = "<?php echo WORDING_FILL_KEYWORD; ?>";




    $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {

        if(index==1) {
            // Verifica se o nome foi preenchido
            if(!$('#nome').val()) {
                $().toastmessage('showToast', {
                    text     : nome,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error',
                    close    : function () {console.log("toast is closed ...");}
                });
                $('#nome').focus();
                return false;
            }
            // Verificar se a URL foi preenchida
            if(!$('#url').valid()) {
                $().toastmessage('showToast', {
                    text     : url,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error',
                    close    : function () {console.log("toast is closed ...");}
                });
                $('#url').focus();
                return false;
            }
            // Verificar se a palavra chave foi preenchida
            if(!$('#palavrachave').valid()) {
                $().toastmessage('showToast', {
                    text     : palavrachave,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error',
                    close    : function () {console.log("toast is closed ...");}
                });
                $('#palavrachave').focus();
                return false;
            }
            // Verificar se a descrição foi preenchida
            if(!$('#descricao').val()) {
                $().toastmessage('showToast', {
                    text     : descricao,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error',
                    close    : function () {console.log("toast is closed ...");}
                });
                $('#descricao').focus();
                return false;
            }

        }

 
        if(index==2) {
        // Make sure we entered the name
            if(!$('#name').val()) {
                alert('You must enter your name');
                $('#name').focus();
                return false;
                }
            }

            
            // Set the name for the next tab
            $('#tab3').html('Hello, ' + $('#name').val());
            
        }, onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;
            var $percent = ($current/$total) * 100;
            $('#rootwizard').find('.bar').css({width:$percent+'%'});
        }});





});
    </script>

<form id="commentForm" method="get" action="" class="form-horizontal">
    <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['user_id']; ?>" />
    <div id="rootwizard">
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
        <ul>
            <li><a href="#tab1" data-toggle="tab"><?php echo WORDING_GENERAL_INFORMATION; ?></a></li>
            <li><a href="#tab2" data-toggle="tab">Second</a></li>
            <li><a href="#tab3" data-toggle="tab">Third</a></li>
            <li><a href="#tab4" data-toggle="tab">Forth</a></li>
            <li><a href="#tab5" data-toggle="tab">Fifth</a></li>
            <li><a href="#tab6" data-toggle="tab">Sixth</a></li>
            <li><a href="#tab7" data-toggle="tab">Seventh</a></li>
        </ul>
         </div>
          </div>
        </div>
        <div id="bar" class="progress progress-striped active">
          <div class="bar"></div>
        </div>
        <div class="tab-content">
            <!-- Inicio-->
            <div class="tab-pane" id="tab1">
                <div class="control-group">
                    <div class="control-group">
                        <label class="control-label" for="name"><?php echo WORDING_NAME; ?></label>
                        <div class="controls">
                            <input type="text" id="nome" name="nome" class="required">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="url"><?php echo WORDING_URL; ?></label>
                        <div class="controls">
                            <input type="text" id="url" name="url" class="required url">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="palavrachave"><?php echo WORDING_KEYWORDS; ?></label>
                        <div class="controls">
                             <input type="text" id="palavrachave" name="palavrachave" class="required">
                             <!-- TRADUZIR -->
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="descricao"><?php echo WORDING_DESCRIPTION; ?></label>
                        <div class="controls">
                            <textarea name="descricao" ROWS="5" COLS="40" id="descricao" name="descricao" class="required"></textarea>
                        </div>
                    </div>




 
                  </div>






            </div>
            <!-- Fim-->
            <div class="tab-pane" id="tab2">
                <p>
                    <input type='text' name='name' id='name' placeholder='Enter Your Name'>
                  </p>
            </div>
            <div class="tab-pane" id="tab3">
                3
            </div>
            <div class="tab-pane" id="tab4">
                4
            </div>
            <div class="tab-pane" id="tab5">
                5
            </div>
            <div class="tab-pane" id="tab6">
                6
            </div>
            <div class="tab-pane" id="tab7">
                7
            </div>
            <ul class="pager wizard">
                <li class="previous first" style="display:none;"><a href="#">First</a></li>
                <li class="previous"><a href="#">Previous</a></li>
                <li class="next last" style="display:none;"><a href="#">Last</a></li>
                <li class="next"><a href="#">Next</a></li>
            </ul>
        </div>  
    </div>
</form>


    <h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>




    <!-- PALAVRA CHAVE -->
    <label for="palavrachave"></label>
    <input id="palavrachave" type="text" name="palavrachave" required />

    <!-- IDIOMA -->
    <label><?php echo WORDING_LANGUAGE; ?></label>
    <select id = "idioma" name="idioma" required="true">
        <option value = "espanhol"><?php echo WORDING_SPANISH ?></option>
        <option value = "ingles"><?php echo WORDING_ENGLISH ?></option>
        <option value = "portugues"><?php echo WORDING_PORTUGUES ?></option>
    </select>
    <br><br>














    <!-- formulario para cadastro de OAS -->
    <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
    <form method="post" action="" name="registrar_novo_OA">
    <!-- CATEGORIA VIDA -->
    <b><?php echo WORDING_LIFE_CATEGORY; ?></b>
    <br><br>

    <!-- DATA -->
    <label for="date"><?php echo WORDING_DATE; ?></label>
    <input id="date" type="date" name="date" required />
    <br><br>

    <!-- STATUS -->
    <label for="status"><?php echo WORDING_STATUS; ?></label>
    <select id = "status" name="status" required="true">
        <option value = "revisado"><?php echo WORDING_REVISED ?></option>
        <option value = "rascunho"><?php echo WORDING_DRAFT ?></option>
        <option value = "editado"><?php echo WORDING_EDITED ?></option>
        <option value = "indisponível"><?php echo WORDING_UNAVAILABLE ?></option>
        <option value = "final"><?php echo WORDING_FINAL ?></option>
    </select>
    <br><br>

    <!-- VERSÃO -->
    <label for="versao"><?php echo WORDING_VERSION; ?></label>
    <input id="versao" type="number" name="versao" min="0" max="100" step="0.1" value="1" required>
    <br><br>


    <!-- ENTIDADE -->
    <label for="entidade"><?php echo WORDING_ENTITY; ?></label>
    <input id="entidade" type="text" name="entidade" required />

    <!-- CONTRIBUIÇÃO -->
    <label for="contribuicao"><?php echo WORDING_CONTRIBUTION; ?></label>
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
    <br><br>

    <!-- CATEGORIA TÉCNICA -->
    <b><?php echo WORDING_TECHNICAL_CATEGORY; ?></b>
    <br><br>

    <!-- TEMPO DO VIDEO -->
    <label for="tempo_video"><?php echo WORDING_VIDEO_TIME; ?></label>
    <input type="datetime-local" name="tempo_video">
    <br><br>

    <!-- TAMANHO -->
    <label for="tamanho"><?php echo WORDING_SIZE; ?></label>
    <input id="tamanho" type="number" name="tamanho" min="0" max="100" step="0.1" value="1" required>
    <br><br>

    <!-- TIPO TECNOLOGIA -->
    <label for="tipoTecnologia"><?php echo WORDING_TECHNOLOGY_TYPE; ?></label>
    <select id = "tipoTecnologia" name="tipoTecnologia" required="true">
        <option value = "navegador"><?php echo WORDING_BROWSER ?></option>
        <option value = "sistema operacional"><?php echo WORDING_OPERATIONAL_SYSTEM ?></option>
    </select>
    <br><br>

    <!-- TIPO FORMATO -->
    <label for="tipoFormato"><?php echo WORDING_FORMAT; ?></label>
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
    <br><br>



    <!-- CATEGORIA EDUCACIONAL -->

    <b><?php echo WORDING_EDUCATIONAL_CATEGORY; ?></b>
    <br><br>

    <!-- DESCRIÇÃO EDUCACIONAL -->
    <label for="descricao_educacional"><?php echo WORDING_EDUCATIONAL_DESCRIPTION; ?></label>
    <textarea name="descricao_educacional" ROWS="5" COLS="40"></textarea>
    <br><br>

    <!-- NÍVEL ITERATIVIDADE -->
    <label for="nivelIteratividade"><?php echo WORDING_ITERABILITY_NIVEL; ?></label>
    <select id = "nivelIteratividade" name="nivelIteratividade" required="true">
        <option value = "muito baixa"><?php echo WORDING_VERY_LOW ?></option>
        <option value = "baixa"><?php echo WORDING_LOW ?></option>
        <option value = "médio"><?php echo WORDING_MIDDLE ?></option>
        <option value = "alto"><?php echo WORDING_HIGH ?></option>
        <option value = "muito alto"><?php echo WORDING_VERY_HIGH ?></option>
    </select>
    <br><br>

    <!-- TIPO ITERATIVIDADE -->
    <label for="tipoIteratividade"><?php echo WORDING_ITERABILITY_TYPE; ?></label>
    <select id = "tipoIteratividade" name="tipoIteratividade" required="true">
        <option value = "ativa"><?php echo WORDING_ACTIVE ?></option>
        <option value = "expositiva"><?php echo WORDING_EXPOSITORY ?></option>
        <option value = "mista"><?php echo WORDING_MIXED ?></option>
    </select>
    <br><br>

    <!-- FAIXA ETÁRIA -->
    <label for="faixaEtaria"><?php echo WORDING_AGE_GROUP; ?></label>
    <select id = "faixaEtaria" name="faixaEtaria" required="true">
        <option value = "criança"><?php echo WORDING_CHILD ?></option>
        <option value = "adulto"><?php echo WORDING_ADULT ?></option>
        <option value = "idoso"><?php echo WORDING_ELDERLY ?></option>
        <option value = "todas as idades"><?php echo WORDING_ALL_AGES ?></option>
    </select>
    <br><br>

    <!-- RECURSO APRENDIZAGEM-->
    <label for="recursoAprendizagem"><?php echo WORDING_LEARNING_RESOURCE; ?></label>
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
    <br><br>

    <!-- USUÁRIO FINAL -->
    <label for="usuarioFinal"><?php echo WORDING_FINAL_USER ; ?></label>
    <select id = "usuarioFinal" name="usuarioFinal" required="true">
        <option value = "professor"><?php echo WORDING_PROFESSOR ?></option>
        <option value = "autor"><?php echo WORDING_AUTHOR ?></option>
        <option value = "aluno"><?php echo WORDING_STUDENT ?></option>
        <option value = "admin"><?php echo WORDING_ADMIN ?></option>
    </select>
    <br><br>

    <!-- AMBIENTE -->
    <label for="ambiente"><?php echo WORDING_AMBIENT ; ?></label>
    <select id = "ambiente" name="ambiente" required="true">
        <option value = "escola"><?php echo WORDING_SCHOOL ?></option>
        <option value = "faculdade"><?php echo WORDING_COLLEGE ?></option>
        <option value = "treinamento"><?php echo WORDING_TRAINING ?></option>
        <option value = "outro"><?php echo WORDING_OTHER ?></option>
    </select>
    <br><br>

    <!-- CATEGORIA DIREITO -->
    <b><?php echo WORDING_RIGHT_CATEGORY; ?></b>
    <br><br>

    <!-- CUSTO -->
    <label for="custo"><?php echo WORDING_COST ; ?></label>
    <input type="radio" name="custo" value="true" id="custo" checked><?php echo WORDING_YES?>
    <input type="radio" name="custo" value="false" id="custo"><?php echo WORDING_NO ?>
    <br><br>

    <!-- DIREITO AUTORAL -->
    <label for="direitoAutoral"><?php echo WORDING_COPYRIGHT ; ?></label>
    <input type="radio" name="direitoAutoral" id="direitoAutoral" value="1" checked><?php echo WORDING_YES?>
    <input type="radio" name="direitoAutoral" id="direitoAutoral" value="0"><?php echo WORDING_NO ?>
    <br><br>

    <!-- USO -->
    <label for="uso"><?php echo WORDING_USE; ?></label>
    <textarea name="uso" ROWS="5" COLS="40"></textarea>
    <br><br>

 

    <input type="submit" name="registrar_novo_OA" value="<?php echo WORDING_CREATE_OA ; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>



    <!-- backlink -->
    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php');

?>