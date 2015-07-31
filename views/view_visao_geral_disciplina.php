<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');

?>
<head>
    <!-- CSS -->
    <link rel="stylesheet" href="css/tooltip.css">
    <link href="css/editar_disciplina.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">




    <!-- JS -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

    <script src="js/jquery.nouislider.all.min.js" type="text/javascript"></script> <!-- Slider -->
    <script type="text/javascript" src="js/jquery.form.js"></script>
    <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        $( "#competenciasDisponiveis" )
          .accordion({
            header: "> div > h3",
            active: false,
            collapsible: true
          })
          .sortable({
            //axis: "y",
            handle: 'h3',
            connectWith: "#competenciasDisciplina",
            //items: '> div > h3',
            stop: function( event, ui ) {
              // IE doesn't register the blur when sorting
              // so trigger focusout handlers to remove .ui-state-focus
              ui.item.children( "h3" ).triggerHandler( "focusout" );
     
              // Refresh accordion to handle new order
              $( this ).accordion( "refresh" );
            },
            update: function(event, ui) {
                var arrayDados = $("#competenciasDisciplina").sortable('toArray').toString();
                //console.log(arrayDados);
                document.getElementById('nomeCompetencia').value = arrayDados;
            }
          });

        $( "#competenciasDisciplina" )
          .accordion({
            header: "> div > h3",
            active: false,
            collapsible: true
          })
          .sortable({
            //axis: "y",
            handle: "h3",
            connectWith: "#competenciasDisponiveis",
            //items: '> div > h3',
            stop: function( event, ui ) {
              // IE doesn't register the blur when sorting
              // so trigger focusout handlers to remove .ui-state-focus
              ui.item.children( "h3" ).triggerHandler( "focusout" );
     
              // Refresh accordion to handle new order
              $( this ).accordion( "refresh" );
            },
            // Preencher array das competências
            update: function(event, ui) {
                var arrayDados = $("#competenciasDisciplina").sortable('toArray').toString();
                //console.log(arrayDados);
                document.getElementById('nomeCompetencia').value = arrayDados;
            },
            // Inicializar array com IDs das competências
            create: function( event, ui ) {
                var arrayDados = $("#competenciasDisciplina").sortable('toArray').toString();
                document.getElementById('nomeCompetencia').value = arrayDados;

            }
          });
        }); //end document ready

		// Tabs function
        $(function() {
            $( "#tabs" ).tabs();
        });

		//Tooltips
		$(function() {
			$( document ).tooltip();
		});

		$(function(){
			$('.input-dados').on('change', function(){
				var valor = this.value;
				var id = this.id;
				var tipo = this.name; // no nome está se é conhecimento, habilidade ou atitude
				var titulo = $(this).prev('h3').text();
				var idDisciplina = <?php echo $_POST["idDisciplina"] ?>;
				jQuery.ajax({
					type: "GET",
					url: "ajax/update_competencia.php",
					data: { 
						valor: valor, 
						id : id,
						tipo : tipo,
						idDisciplina : idDisciplina,
					},
					cache: false,
					// importantinho.
					error: function(e){
						alert(e);
					},
					success: function(response){
						//console.log(response);
						var n = noty({
						    text: 'Competência atualizada com sucesso',
						    layout: 'topCenter',
    						theme: 'relax', // or 'relax'
    						type: 'information',
    						killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
						    animation: {
						        open: {height: 'toggle'}, // jQuery animate function property object
						        close: {height: 'toggle'}, // jQuery animate function property object
						        easing: 'swing', // easing
						        speed: 200 // opening & closing animation speed
						    },
						    timeout: 200
						    // Desaparecer
						    
						});
					}
				});
				//console.log(this.value);
			});
		});

    </script>
</head>

    <div class="fixedBackgroundGradient">
    </div>
    <div class="cadastrobase">
        <?php 
        $nomeDisciplina = $disciplina->getNomeDisciplinaById($_POST['idDisciplina'])[0][0];
        $nomeCurso = $disciplina->getNomeCursoById($_POST['idDisciplina'])[0][0];
        $descricao = $disciplina->getDescricaoDisciplinaById($_POST['idDisciplina'])[0][0];
        $idDisciplina = $_POST['idDisciplina'];
        ?>
        <div class="top-cadastrobase">
            <div class="text-left"><?php echo (WORDING_GLOBAL_COURSE).': '.$nomeDisciplina; ?>
            </div>
            <div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>-->
            </div>
        </div>
            <div class="cadastrobase-content">
                <div id="tabs">
                    <ul>
                        <li><a href="#tabs-1">Alterar dados gerais</a></li>
                        <li><a href="#tabs-2">Alunos Matriculados</a></li>
                        <li><a href="#tabs-3">OAS Vinculados</a></li>
                        <li><a href="#tabs-4">Alterar competências</a></li>
                    </ul>
                    <div id="tabs-1">
                        <form method="post" action="editar_disciplina.php" name="editar_nome_disciplina">
                            <label for="disciplina_name"><?php echo WORDING_NEW_DISCIPLINA_NAME; ?></label>
                            <input id="disciplina_name" type="text" name="disciplina_name"/> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $nomeDisciplina; ?>)<br />
                            <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                            <input type="submit" name="editar_nome_disciplina" value="<?php echo WORDING_CHANGE_DISCIPLINA_NAME; ?>" />
                        </form><hr/>
                        <!-- Formulário para editar o nome do curso -->
                        <form method="post" action="editar_disciplina.php" name="editar_nome_curso">                  
                            <label for="curso_name"><?php echo WORDING_NEW_COURSE_NAME; ?></label>
                            <input id="curso_name" type="text" name="curso_name" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $nomeCurso; ?>)<br />
                            <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                            <input type="submit" name="editar_nome_curso" value="<?php echo WORDING_CHANGE_COURSE_NAME; ?>" />
                        </form><hr/>
                        <!-- Alterar a senha da disciplina -->
                        <form method="post" action="editar_disciplina.php" name="editar_senha">
                            <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                            <label for="senha_antiga"><?php echo WORDING_NEW_PASSWORD; ?></label>
                            <input id="senha_antiga" type="password" name="senha_antiga" autocomplete="off" />
                            <label for="senha_nova"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
                            <input id="senha_nova" type="password" name="senha_nova" autocomplete="off" />
                            <input type="submit" name="editar_senha" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
                        </form>
                         <!-- Alterar a descrição da disciplina -->
                        <form method="post" action="editar_disciplina.php" name="editar_descricao">
                            <label for="descricao"><?php echo WORDING_NEW_DESCRIPTION; ?></label>
                            <?php echo WORDING_CURRENTLY; ?>:<br/>
                            <?php echo $descricao; ?>
                            <br/>
                            <textarea name="descricao" id="descricao" rows="5" cols="40" class="required" aria-required="true" style="width: 100%; height: 150px;"></textarea>
                            <input type="hidden" name="idDisciplina" value="<?php echo $idDisciplina ?>" />
                            <input type="submit" name="editar_descricao" value="<?php echo WORDING_EDIT_DESCRIPTION; ?>" />
                        </form>  
                    </div> <!-- END TAB 1-->
                    <div id="tabs-2">
                         <?php
                            $listaAlunosMatriculados = $disciplina->listaAlunosMatriculados($_POST['idDisciplina']);
                            if (empty($listaAlunosMatriculados))
                               echo 'Nenhum aluno matriculado';
                            else{ ?>
                               <table class="table table-condensed">
                                <thead>
                                <tr>
                                    <th>Nome de Usuário</th>
                                    <th>Email</th>
                                    <th>Tipo de Usuário</th>
                                </tr>
                                </thead>
                                    <tbody>
                                    <?php
                                    $qtde = count($listaAlunosMatriculados);
                                    for($i=0; $i < $qtde; $i++){
                                    $idUser = $listaAlunosMatriculados[$i]['usuario_idusuario'];
                                    $dadosUsuario = $disciplina->getUserData($idUser);
                                    echo
                                        "<tr>".
                                        "<td>".$dadosUsuario[0]['user_name']."</td>".
                                        "<td>".$dadosUsuario[0]['user_email']."</td>";
                                        if ($dadosUsuario[0]['acesso'] == 1)
                                            echo "<td>".WORDING_USER_STUDENT."</td>";
                                        elseif ($dadosUsuario[0]['acesso'] == 2)
                                            echo "<td>".WORDING_USER_PROFESSOR."</td>";
                                        elseif ($dadosUsuario[0]['acesso'] == 3)
                                            echo "<td>".WORDING_USER_ADMIN."</td>";
                                        echo "</tr>";
                               }
                           }
                           ?>
                                    </tbody>
                                </table>        
                    </div> <!-- END TAB 2 -->
                    <div id="tabs-3">
                        <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                    </div>
                    <!-- Dados da competência -->
                    <div id="tabs-4">
                        <!-- Lista de competências -->
                        <form method="post" action="editar_disciplina.php" name="editar_competencia" class="editarCompetencia">
                                <input type="hidden" id="nomeCompetencia" value="" />
                                <h3>Editar Competências</h3>    
                                    <!-- DIV com as competências do sistema -->

                                    <div id="competenciasDisponiveis">
                                        <div class"tituloTabelaCompetencias">
                                            Competências disponíveis
                                        </div>
                                        <?php
                                        $comp = new Competencia();
                                        $competencias = $comp->getListaCompetenciaDisciplina($_POST['idDisciplina'],false);
                                        $contador = count($competencias);
                                        for($i=0;$i<$contador;$i++){ ?>                           
                                            <div class="group" id="<?php echo "".$competencias[$i]['idcompetencia']; ?>">
                                                <h3 >
                                                <?php echo "".$competencias[$i]['nome']; ?>
                                                </h3>
                                                <div>
                                                    Descrição: 
                                                    <div class="alert alert-info" role="alert">
                                                        <p><?php echo "".$competencias[$i]['descricao_nome']; ?></p>
                                                    </div>

                                                </div>

                                            </div>
                                    <?php 
                                        } //end for
                                    ?>
                                    </div>
                                    
                                    <!-- DIV com competências da disciplina a ser editada -->
                                    <div id="competenciasDisciplina">
                                        <div class"tituloTabelaCompetencias">
                                            Competências disponíveis
                                        </div>
                                        <?php
                                        $comp = new Competencia();
                                        $competencias = $comp->getListaCompetenciaDisciplina($_POST['idDisciplina'],true);
                                        // Pega os dados das competências para essa disciplina
                                        $conhecimento = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'conhecimento');
                                        $habilidade = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'habilidade');
                                        $atitude = $disciplina->getCompetenciasDisciplina($_POST['idDisciplina'], 'atitude');
                                        //echo '<pre>';
                                        //$coisas = array($conhecimento, $habilidade, $atitude);
                                        //print_r($conhecimento);
                                        //echo $conhecimento[0]['conhecimento'];
                                        $contador = count($competencias);
                                        for($i=0;$i<$contador;$i++){ 
                                        	$idCompetencia = $competencias[$i]['idcompetencia'];
                                        	$descricaoConhecimento = $comp->getDescricaoConhecimentoById($idCompetencia);
                                        	$descricaoHabilidade = $comp->getDescricaoHabilidadeById($idCompetencia);
                                        	$descricaoAtitude = $comp->getDescricaoAtitudeById($idCompetencia);
                                        	//echo '<pre>';
                                        	//print_r($descricaoConhecimento);
                                        	?>
                                            <div class="group" id="<?php echo "".$idCompetencia; ?>">
                                                <h3 >
                                                <?php echo "".$competencias[$i]['nome']; ?>
                                                </h3>
                                                <div>
                                                    Descrição:
                                                    <div class="alert alert-info" role="alert">
                                                        <p><?php echo "".$competencias[$i]['descricao_nome']; ?></p>
                                                    </div>
                                                    <!-- Conhecimento -->
                                                    <div class"content-valor-competencias">
	                                                   	<label for="conhecimento" title="<?php echo "".$descricaoConhecimento['conhecimento_descricao']; ?>">Conhecimento: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                    	<br>
                                                    	<input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="conhecimento" type="number" min="0" max="5" value="<?php echo "".$conhecimento[$i]['conhecimento']; ?>" ></input>
                                                    </div>
                                                    <br>
                                                    <!-- Habilidade -->
                                                    <div class"content-valor-competencias">
                                                    	<label for="habilidade" title="<?php echo "".$descricaoHabilidade['habilidade_descricao']; ?>">Habilidade: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                    	<br>
                                                    	<input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="habilidade" type="number" min="0" max="5" value="<?php echo "".$habilidade[$i]['habilidade']; ?>" ></input>

                                                	</div>
                                                	<br>
                                                    <!-- Atitude -->
                                                    <div class"content-valor-competencias">
                                                    	<label for="atitude" title="<?php echo "".$descricaoAtitude['atitude_descricao']; ?>">Atitude: <span class="glyphicon glyphicon-question-sign"></span></label>
                                                    	<br>
                                                    	<input class="input-dados" id="<?php echo "".$idCompetencia; ?>" name="atitude" type="number" min="0" max="5" value="<?php echo "".$atitude[$i]['atitude']; ?>" ></input>
                                                	</div>
                                                </div>

                                            </div>
                                    <?php 
                                        } //end for
                                    ?>
                                    </div>
                        </form>
                    </div> <!-- END Dados da competencia-->
            </div> <!-- END DIV TABS -->
        </div> <!-- END cadastrobase-content -->
    </div> <!-- END cadastrobase -->
    





<!-- style="background-color: rgba(0, 0, 0, 0.8); height: 100%; width: 100%; position: fixed; top: 55px; left: 0px;"-->
<?php include('_footer.php'); ?>