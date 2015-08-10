<?php include('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

<!-- Home -->

<!-- Custom CSS -->
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
<?php require_once("views/sidebar-disciplina.php"); ?>

<!-- ============== DISCIPLINAS ============== -->

<div class="disciplinas">
<div class="top-disciplinas">Minhas Disciplinas</div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">

            <?php
                //print_r($_SESSION['acesso']);
                // Trocar 2 por constante de acesso de administrador
                if ($_SESSION['acesso'] == 2){
                    $idDisci = $disciplina->getIdDisciplinasMatriculadas($_SESSION['user_id']);
                    for ($i = 0; $i < sizeof($idDisci); $i++) {
                        $nomeDisci = $disciplina->getNomeDisciplinaById($idDisci[$i][0]);
                        $nomeCurso = $disciplina->getNomeCursoById($idDisci[$i][0]);
                        $professorID = $disciplina->getProfessorDisciplinaById($idDisci[$i][0]);
                        $professorDisci = $disciplina->getProfessorNomeById($professorID[0][0]);
                        $descricaoDisci = $disciplina->getDescricaoDisciplinaById($idDisci[$i][0]);
                        $criadorDisciplinaId = $disciplina->getDisciplinaCreatorIdByID($idDisci[$i][0]);
                        if ($criadorDisciplinaId[0][0] == $_SESSION['user_id']){
                            echo
                                "<li class='disciplinas-item'>".
                                    "<div class='disciplina-item-content'>".
                                        "<h3>".$nomeDisci[0][0]."</h3>".
                                        "<h4>".$nomeCurso[0][0]." - ".$professorDisci[0][0]."</h4>".
                                        "<p>".$descricaoDisci[0][0]."</p>".
                                    "</form>".
                                    "</div>".
                                    "<div style='position: relative; float: right; width: 30%;'>".
                                        "<div class='button'><form action='cadastro_disciplina_cha_teste.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                            "<input type='hidden' name='disc' value='".$idDisci[$i][0]."'>".
                                            "<input type='submit' value='Testar Recomendação'></br></br>".
                                            "</form>".
                                        "</div>".
                                        "<div class='button'><form action='editarDisciplina.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                            "<input type='hidden' name='disc' value='".$idDisci[$i][0]."'>".
                                            "<input type='submit' value='Visualizar/Editar Disciplina'></br></br>".
                                            "</form>".
                                        "</div>".
                                    "</div>".
                                "</li>";
                        }else{
                            echo
                                "<li class='disciplinas-item'>".
                                    "<div class='disciplina-item-content'>".
                                        "<h3>".$nomeDisci[0][0]."</h3>".
                                        "<h4>".$nomeCurso[0][0]." - ".$professorDisci[0][0]."</h4>".
                                        "<p>".$descricaoDisci[0][0]."</p>".
                                    "</form>".
                                    "</div>".
                                    "<div style='position: relative; float: right; width: 30%;'>".
                                        "<center><div class='button'><form action='cadastro_disciplina_cha_teste.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                        "<input type='hidden' name='disc' value='".$idDisci[$i][0]."'>".
                                        "<input type='submit' value='Testar Recomendação'></br></br>".
                                    "</div>".
                                "</li>";
                        };
                            
                    }
                }
                else{
                    $idDisci = $disciplina->getIdDisciplinasMatriculadas($_SESSION['user_id']);
                    for ($i = 0; $i < sizeof($idDisci); $i++) {
                        $nomeDisci = $disciplina->getNomeDisciplinaById($idDisci[$i][0]);
                        $nomeCurso = $disciplina->getNomeCursoById($idDisci[$i][0]);
                        $professorID = $disciplina->getProfessorDisciplinaById($idDisci[$i][0]);
                        $professorDisci = $disciplina->getProfessorNomeById($professorID[0][0]);
                        $descricaoDisci = $disciplina->getDescricaoDisciplinaById($idDisci[$i][0]);
                        echo
                            "<li class='disciplinas-item'>".
                                "<div class='disciplina-item-content'>".
                                    "<h3>".$nomeDisci[0][0]."</h3>".
                                    "<h4>".$nomeCurso[0][0]." - ".$professorDisci[0][0]."</h4>".
                                    "<p>".$descricaoDisci[0][0]."</p>".
                                "</div>".
                                "<div style='position: relative; float: right; width: 30%;'>".
                                    "<center><div class='button'><form action='recomendacao.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                        "<input type='hidden' name='disc' value='".$idDisci[$i][0]."'>".
                                        "<input type='submit' value='Receber Recomendação'></br></br>".
                                    "</form>".
                                    "</div></center>".
                                "</div>".
                            "</li>";
                    }
                }
            ?>
            </ul>
         </div>  
</div>


</div>


<?php include('_footer.php'); ?>