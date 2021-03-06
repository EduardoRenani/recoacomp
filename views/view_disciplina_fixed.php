<?php include('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

<!-- Home -->

<!-- Custom CSS -->
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="css/home.css" rel="stylesheet">
<link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
<link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
<link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />

<!-- Custom Fonts -->
<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<!-- Fim Home -->

</head>
<div class="fixedBackgroundGradient"></div>
<?php require_once("sidebar-disciplina.php"); ?>

<!-- ============== DISCIPLINAS ============== -->

<div class="disciplinas">
<div class="top-disciplinas">Atividades em que estou matriculado(a)</div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">

            <?php
                // PASSO 1: PREENCHER O CHA
                

                //PASSO 2: PEGAR A LISTA DE DISCIPLINAS DO USUÁRIO

                $listaDisc = array();
                        /* Create a new mysqli object with database connection parameters */
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if(mysqli_connect_errno()) {
                    echo "Connection Failed: " . mysqli_connect_errno();
                    exit();
                }

                /* Create a prepared statement */
                if($stmt = $mysqli -> prepare("SELECT `disciplina_iddisciplina`FROM `usuario_disciplina` WHERE `usuario_idusuario`=?")) {

                    /* Bind parameters
                    s - string, b - blob, i - int, etc */
                    $stmt -> bind_param("i", $_SESSION['user_id']);

                    /* Execute it */
                    $stmt -> execute();

                    /* Bind results */
                    $stmt -> bind_result($result);

                    /* Fetch the value */
                    while ($stmt -> fetch() ){
                        array_push($listaDisc, $result);
                    }

                    /* Close statement */
                    $stmt -> close();
                }

                /* Close connection */
                //$mysqli -> close();   <-- Fazer depois.

                //PASSO 2: TRATAR CADA DISCIPLINA 1 A 1.
                $cont = count($listaDisc);
                
                for($i=0;$i<$cont;$i++){
                    $carregamento = new Carregamento;
                    $disciplina = $carregamento->CarregaDados(array("iddisciplina" => $listaDisc[$i]), "disciplina");
                    if(!$disciplina['excluida']) {
                        $professor = $carregamento->CarregaDados(array("user_id" => $disciplina['usuarioProfessorID']), "users");
						if($disciplina['tipo_atividade'] == ATIVIDADE_DISCIPLINA) {
							$tipo_atividade = "Disciplina";
						}
						else if($disciplina['tipo_atividade'] == ATIVIDADE_CURSO) {
							$tipo_atividade = "Curso";
						}
						else if($disciplina['tipo_atividade'] == ATIVIDADE_PROJETO) {
							$tipo_atividade = "Projeto";
						}
						else if($disciplina['tipo_atividade'] == ATIVIDADE_OUTROS) {
							$tipo_atividade = "Outros";
						}
                        $new_disciplina = new Disciplina();
                        if(!$new_disciplina->hasInstrumento() || (!$new_disciplina->checkMeio($listaDisc[$i]) && !$new_disciplina->checkFim($listaDisc[$i]))) {
                            echo "<li class='disciplinas-item'>".
                                    "<div class='disciplina-item-content'>".
                                        "<h3>".$disciplina['nomeDisciplina']."(".$tipo_atividade.")</h3>".
                                        "<h4>".$disciplina['nomeCurso']." - ".$professor['user_name']."</h4>".
                                        "<p>".$disciplina['descricao']."</p>".
                                    "</div>".
                                    "<div class='button'><form action='recomendacao.php?codTipoUsuario=".$_GET['codTipoUsuario']."' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                        "<input type='hidden' name='disc' value='".$listaDisc[ $i ]."'>".
                                        "<input type='submit' value='Receber Recomendação'></br></br>".
                                    "</form></div>".
                                "</li>";
                        }
                        else if($new_disciplina->hasInstrumento() && $new_disciplina->checkMeio($listaDisc[$i])) {
                            echo "<li class='disciplinas-item'>".
                                    "<div class='disciplina-item-content'>".
                                        "<h3>".$disciplina['nomeDisciplina']."(".$tipo_atividade.")</h3>".
                                        "<h4>".$disciplina['nomeCurso']." - ".$professor['user_name']."</h4>".
                                        "<p>".$disciplina['descricao']."</p>".
                                    "</div>".
                                    "<div class='button'><form method='post' action='cadastro_disciplina_cha.php?redirecionar=1&codTipoUsuario=".$_GET['codTipoUsuario']."' name='senha_disciplina'>
                                        <input type='hidden' name='senha' value='".$disciplina['senha']."'>
                                        <input type='hidden' id='idUsuario' name='idUsuario' value='".$_SESSION['user_id']."'>
                                        <input type='hidden' id='idDisciplina' name='idDisciplina' value='".$listaDisc[$i]."'>
                                        <input type='hidden' name='okay' value='nope'>
                                        <input type='hidden' id='link' name='link' value='/recoacomp/disciplinas_disponiveis.php'>
                                        <input type='submit' name='verifica_senha' action='' value='Receber Recomendação'>
                                    </form></div>".
                                "</li>";
                        }
                        else if($new_disciplina->hasInstrumento()) {
                            echo "<li class='disciplinas-item'>".
                                    "<div class='disciplina-item-content'>".
                                        "<h3>".$disciplina['nomeDisciplina']."(".$tipo_atividade.")</h3>".
                                        "<h4>".$disciplina['nomeCurso']." - ".$professor['user_name']."</h4>".
                                        "<p>".$disciplina['descricao']."</p>".
                                    "</div>".
                                    "<div class='button'><form method='post' action='cadastro_disciplina_cha.php?redirecionar=1&codTipoUsuario=".$_GET['codTipoUsuario']."' name='senha_disciplina'>
                                        <input type='hidden' name='senha' value='".$disciplina['senha']."'>
                                        <input type='hidden' id='idUsuario' name='idUsuario' value='".$_SESSION['user_id']."'>
                                        <input type='hidden' id='idDisciplina' name='idDisciplina' value='".$listaDisc[$i]."'>
                                        <input type='hidden' name='okay' value='nope'>
                                        <input type='hidden' id='link' name='link' value='/recoacomp/disciplinas_disponiveis.php'>
                                        <input type='submit' name='verifica_senha' action='' value='Receber Recomendação'>
                                    </form></div>".
                                "</li>";
                        }
                    }
                    unset($disc);
                }
                $mysqli -> close();
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
                        <!--
                        <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Ergonomia Aplicada ao Design II</h3> <!--nomes de cadeiras servem só de exemplo do funcionamento--
                                <h4>Júlio Van der Linden - ARQ03140</h4>
                                <p>Conhecimento dos fundamentos da ergonomia Cognitiva, da Interação Homem Computador e da Experiência do Usuário.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"--
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                         <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Ciência e Tecnologia dos Materiais</h3>
                                <h4>Annelise Alves - ENG02033</h4>
                                <p>Correlação entre propriedades, estrutura, processos de fabricação e desempenho dos diferentes materiais utilizados em produtos
industriais.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"--
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                         <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Design Contenporâneo: Teoria e História</h3>
                                <h4>Maria do Carmo Curtis - ARQ03114</h4>
                                <p>Correntes atuais e as diferentes práticas e resultados obtidos por profissionais do design no âmbito internacional. Os vários graus de
industrialização no mundo. Países na periferia da industrialização.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"--
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>-->
            </ul>
         </div>  
</div>


</div>


<?php include('_footer.php'); ?>
