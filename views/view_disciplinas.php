<?php include_once('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

    <!-- Home -->

    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />
    <link href="css/editar_disciplina.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
    <!-- Fim Home -->
    <script type="text/javascript">
    // Variável global pq sim
    var idDisciplina;

    function getDisciplinaId(id){
        var disciplinaId = id;
        document.getElementById('idDisciplina').value = id;
        idDisciplina = id;
    }

    function deletarDisciplina() {
        //console.log(idDisciplina);
        jQuery.ajax({
            type: "GET",
            url: "ajax/exclui_disciplina.php",
            data: { 
                idDisciplina : idDisciplina,
            },
            cache: false,
            // importantinho.
            error: function(e){
                alert(e);
            },
            success: function(response){
                location.reload();
        }
    });
        
    }





</script>

</head>
<div class="fixedBackgroundGradient"></div>
<!-- ============== SIDEBAR =============== -->
<?php require_once("views/sidebar-disciplina.php"); ?>

<!-- ============== DISCIPLINAS DIPONIVEIS ============== -->

<div class="disciplinas">
    <div class="top-disciplinas">Minhas Atividades</div>
        <div class="disciplinas-content">
            <ul class="disciplinas-list">
            <?php
                // Exibir todas as disciplinas disponiveis e permitir cadastros nas mesmas
                $listaDisciplina = array();

                $disciplinasOrdemAlfabetica = $disciplina->getUserDisciplinasByASC($_SESSION['user_id']);

                $listaDisciplina[0] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'nomeDisciplina');
                $listaDisciplina[1] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'nomeCurso');
                $listaDisciplina[2] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'descricao');
                $listaDisciplina[3] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'id');
                $listaDisciplina[4] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'tipo_atividade');



                foreach ($disciplinasOrdemAlfabetica as $ordemAlfabetica => $new_disciplina) {
					if($new_disciplina['tipo_atividade'] == ATIVIDADE_DISCIPLINA) {
						$new_disciplina['tipo_atividade'] = "Atividade de Ensino";
					} else if($new_disciplina['tipo_atividade'] == ATIVIDADE_CURSO) {
						$new_disciplina['tipo_atividade'] = "Curso";
					} else if($new_disciplina['tipo_atividade'] == ATIVIDADE_PROJETO) {
						$new_disciplina['tipo_atividade'] = "Projeto";
					} else if($new_disciplina['tipo_atividade'] == ATIVIDADE_OUTROS) {
						$new_disciplina['tipo_atividade'] = "Outros";
					}
                    // Se a disciplina não estiver com a flag excluida ela será mostrada
                    if($new_disciplina['excluida'] === '0'){
                        if(!(isset($_POST['codTipoUsuario']))){
                            echo
                                "<li class='disciplinas-item'>".
                                    "<div class='disciplina-item-content'>".
                                        "<div class='lista-disciplina'>".
                                            "<h3>".$new_disciplina['nomeDisciplina']." (".$new_disciplina['tipo_atividade'].")</h3>".
                                            "<h4>".$new_disciplina['nomeCurso']."</h4>".
                                            "<p>".$new_disciplina['descricao'].
                                            "<br>".
                                            "<br><a href='#openModalDeleteDisciplina' id=".$new_disciplina['iddisciplina']." class='botao-med' onClick='getDisciplinaId(this.id)'>Excluir</a>". // 
                                        "</div>".
                                    "</div>".
                                    "<div style='display: block;'>".
                                        "<form method='post' action='editar_disciplina.php' name='senha_disciplina'>".
                                            "<input type='hidden' id='idDisciplina' name='idDisciplina' value=".$new_disciplina['iddisciplina']." />".
                                            "<input type='submit' name='editar_disciplina.php' action='' value='Informações da Disciplina' />".
                                        "</form>".
                                        "<div class='button'>".
                                        "<form action='cadastro_disciplina_cha_teste.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                           "<input type='hidden' name='disc' value='".$new_disciplina['iddisciplina']."'>".
                                            "<input type='submit' value='Testar Recomendação'></br></br>".
                                            "</form>".
                                        "</div>".
                                    "</div>".
                                "</li>";
                        ?>
                        <!-- Modal -->
                        <div id="openModalDeleteDisciplina" class="modalDialog" id="excluirDisciplinaDialog">
                                <div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="top-cadastro"><?php echo 'Excluir atividade de ensino?'; ?></div>
                                        <a href="#close" class="botao-med" id="<?php echo $disciplina['iddisciplina']?>" onClick="deletarDisciplina();" title="Deletar">Excluir</a>
                                        <hr>
                                        <a href="#close" class="botao-med" title="Cancelar">Cancelar</a>
                                    <!--/div-->
                                </div>
                                <!-- /.top-cadastro -->
                        </div>
<?php                   } else { //  Se tiver setado o _POST pra ver como aluno/professor
                            $tipoUsuario = $_POST['codTipoUsuario'];
                                if($tipoUsuario == 2){ // Se a visão estiver de aluno não mostrar ver disciplina mas sim disciplinas em que estou matriculado
                                echo
                                    "<li class='disciplinas-item'>".
                                        "<div class='disciplina-item-content'>".
                                            "<div class='lista-disciplina'>".
											"<h2>".$disciplina['tipo_atividade']."</h2>".
                                                "<h3>".$disciplina['nomeDisciplina']."</h3>".
                                                "<h4>".$disciplina['nomeCurso']."</h4>".
                                                "<p>".$disciplina['descricao']."</p>".
                                                "<p></p>".
                                                "<br>".
                                                "<br><a href='#openModalDeleteDisciplina' id=".$disciplina['iddisciplina']." class='botao-med' onClick='getDisciplinaId(this.id)'>Excluir</a>". // 
                                            "</div>".
                                        "</div>".
                                        "<div style='display: block;'>".
                                            "<form method='post' action='editar_disciplina.php' name='senha_disciplina'>".
                                                "<input type='hidden' id='idDisciplina' name='idDisciplina' value=".$disciplina['iddisciplina']." />".
                                                "<input type='submit' name='editar_disciplina.php' action='' value='Ver Disciplina' />".
                                            "</form>".
                                            "<div class='button'>".
                                            "<form action='cadastro_disciplina_cha_teste.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                               "<input type='hidden' name='disc' value='".$disciplina['iddisciplina']."'>".
                                                "<input type='submit' value='Testar Recomendação'></br></br>".
                                                "</form>".
                                            "</div>".
                                        "</div>".
                                    "</li>";
                                    ?>
                                    <!-- Modal -->
                                    <div id="openModalDeleteDisciplina" class="modalDialog" id="excluirDisciplinaDialog">
                                            <div>
                                                <a href="#close" title="Close" class="close">X</a>
                                                <div class="top-cadastro"><?php echo 'Excluir disciplina?'; ?></div>
                                                    <a href="#close" class="botao-med" id="<?php echo $disciplina['iddisciplina']?>" onClick="deletarDisciplina();" title="Deletar">Excluir</a>
                                                    <a href="#close" class="botao-med" title="Cancelar">Cancelar</a>
                                                <!--/div-->
                                            </div>
                                            <!-- /.top-cadastro -->
                                    </div>
<?php                           } elseif ($tipoUsuario == 1){
                                    echo
                                        "<li class='disciplinas-item'>".
                                            "<div class='disciplina-item-content'>".
                                                "<div class='lista-disciplina'>".
												"<h2>".$disciplina['tipo_atividade']."</h2>".
                                                    "<h3>".$disciplina['nomeDisciplina']."</h3>".
                                                    "<h4>".$disciplina['nomeCurso']."</h4>".
                                                    "<p>".$disciplina['descricao'].
                                                    "<br>".
                                                "</div>".
                                            "</div>".
                                            "<div style='display: block;'>".
                                                "<div class='button'>".
                                                "<form action='cadastro_disciplina_cha_teste.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                                   "<input type='hidden' name='disc' value='".$disciplina['iddisciplina']."'>".
                                                    "<input type='submit' value='Solicitar Recomendação'></br></br>".
                                                    "</form>".
                                                "</div>".
                                            "</div>".
                                        "</li>";
                                } // end elseif
                            } // end if isset
                         }// end if excluida
                        //<!-- /.modalDialog -->
                     } // end for
                    
?>

                        <!-- Modal -->
                        <div id="openModalCreateDisciplina" class="modalDialog" id="criarDisciplinaDialog">
                                <div>
                                    <a href="#close" title="Close" class="close">X</a>
                                    <div class="top-cadastro"><?php echo 'Criar que tipo de atividade?'; ?></div>
                                        <a href="cadastro_disciplina.php?tipo=disciplina" class="botao-med" title="Disciplina">Disciplina</a>
                                        <hr>
                                        <a href="cadastro_disciplina.php?tipo=curso" class="botao-med" title="Curso">Curso</a>
                                        <hr>
                                        <a href="cadastro_disciplina.php?tipo=projeto" class="botao-med" title="Projeto">Projeto</a>
                                        <hr>
                                        <a href="cadastro_disciplina.php?tipo=outros" class="botao-med" title="Curso">Outros</a>
                                    <!--/div-->
                                </div>
                                <!-- /.top-cadastro -->
                        </div>
<?php
/*
                $listaDisciplina[0] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'nomeDisciplina');
                $listaDisciplina[1] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'nomeCurso');
                $listaDisciplina[2] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'descricao');
                $listaDisciplina[3] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'id');

                $contador = count($listaDisciplina[0]);
                //Imprime o nome de cada disciplina
                //print_r($listaDisciplina[0]);
*/
                ?>
            </ul>
         </div>  

</div>

