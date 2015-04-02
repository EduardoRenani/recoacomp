<?php
/**
 * Created by PhpStorm.
 * User: Delton Vaz
 * Date: 14/01/2015
 * Time: 17:36
 */

include('_header.php');
require_once("classes/OA.php");?>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link href="css/base_cadastro_objeto.css" rel="stylesheet">
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
    </style>

    <!-- BREADCRUMB BONITO-->
    <script src="http://thecodeplayer.com/uploads/js/prefixfree-1.0.7.js" type="text/javascript" type="text/javascript"></script>



<!-- clean separation of HTML and PHP -->
<script>
$(function() {

    var $validator = $("#registrar_novo_OA").validate({
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
    var data = "<?php echo WORDING_FILL_DATE; ?>";
    var descricao_educacional = "<?php echo WORDING_FILL_EDUCACIONAL_DESCRIPTION; ?>";


    $('#rootwizard').bootstrapWizard({onNext: function(tab, navigation, index) {
    // Categoria geral
        if(index==1) {
            // Verifica se o nome foi preenchido caso contrário dá um aviso
            if(!$('#nome').val()) {
                $().toastmessage('showToast', {
                    text     : nome,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
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
                    type     : 'error'
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
                    type     : 'error'
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
                    type     : 'error'
                });
                $('#descricao').focus();
                return false;
            }
        }

        // Se estiver na aba da categoria vida, fazer verficações 
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
		if(index==4) {
        // Make sure we entered the description
            if(!$('#descricao_educacional').val()) {
                $().toastmessage('showToast', {
                    text     : descricao_educacional,
                    sticky   : false,
                    position : 'top-left',
                    type     : 'error'
                });
                $('#descricao_educacional').focus();
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

<div class="fixedBackgroundGradient"></div>
<div class="cadastrobase">
<div class="top-cadastrobase"><?=WORDING_REGISTER_NOVO_OA?></div>
<div class="cadastrobase-content">
<form id="registrar_novo_OA" method="post" action="" name="registrar_novo_OA" class="form-horizontal" style="width: 100%;">
    <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['user_id']; ?>" />
    <div id="rootwizard">
        <div class="navbar" style="margin: 0 auto; width: 97%; margin-bottom: 20px;">
            <div class="navbar-inner">
                <div class="container">
                    <ul>
                        <li><a href="#tab1" data-toggle="tab"><?php echo WORDING_GENERAL_INFORMATION; ?></a></li>
                        <li><a href="#tab2" data-toggle="tab"><?php echo WORDING_LIFE_CATEGORY; ?></a></li>
                        <li><a href="#tab3" data-toggle="tab"><?php echo WORDING_TECHNICAL_CATEGORY; ?></a></li>
                        <li><a href="#tab4" data-toggle="tab"><?php echo WORDING_EDUCATIONAL_CATEGORY; ?></a></li>
                        <li><a href="#tab5" data-toggle="tab"><?php echo WORDING_RIGHT_CATEGORY; ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="bar" class="progress progress-striped active" style="margin: 0 auto; width: 97%; margin-bottom: 20px;">
            <div class="bar">
            </div>
        </div>
        <div class="tab-content" style="margin: 0 auto; width: 70%; margin-bottom: 20px;">
        <!-- Inicio-->
            <div class="tab-pane" id="tab1"> 
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
                        <!-- input class="palavra_chave" multiple="multiple" id="palavrachave" name="palavrachave" class="required"/-->
                        <input type="text" data-role="tagsinput" id="palavrachave" name="palavrachave" class="required"/>
                        
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
            <div class="tab-pane" id="tab2">
                    <div class="control-group">
                        <label class="control-label" for="date"><?php echo WORDING_DATE; ?></label>
                        <div class="controls">
                            <input id="date" type="date" name="date" required />
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
            <div class="tab-pane" id="tab3">
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
            <div class="tab-pane" id="tab4">
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
            <div class="tab-pane" id="tab5">
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

			
			<ul class="pager wizard">
                            <input id="finisher" style="display:none;" type="submit" name="registrar_novo_OA" value="<?php echo WORDING_CREATE_OA ; ?>" />
                <li class="next" style="float:none"><div class='button'><a href="javascript:;" class='button-next text-left'>Próximo</a></div></li>
                <li class="previous" style="float:none"><div class="text-right"><a href="javascript:;">Voltar</a></div></li>
            </ul>
			

  
        </div>  
    </div>
    <!-- <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" /> -->
</form>
</div>
</div>
    <!-- formulario para cadastro de OAS -->
    <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->




    <!-- backlink -->
    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php');

?>