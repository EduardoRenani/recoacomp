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
<?php require_once("sidebar-disciplina.php"); ?>

<!-- ============== DISCIPLINAS ============== -->

<div class="disciplinas">
<div class="top-disciplinas">Minhas Disciplinas</div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">

            <?php
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
                            "<div class='button'><form action='recomendacao.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                "<input type='hidden' name='disc' value='".$idDisci[$i][0]."'>".
                                "<input type='submit' value='Receber Recomendação'></br></br>".
                            "</form></div>".
                        "</li>";
                }
            ?>
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
