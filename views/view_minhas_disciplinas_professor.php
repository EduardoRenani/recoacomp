<?php include_once('_header.php'); ?>

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
<script type="text/javascript">
function getDisciplinaId(id){
    var disciplinaId = id;
    document.getElementById('idDisciplina').value = id;
    //alert(id);
}
</script>

</head>

<div class="fixedBackgroundGradient"></div>
<!-- ============== SIDEBAR =============== -->
<?php include_once("sidebar.php"); ?>

<!-- ============== DISCIPLINAS DIPONIVEIS ============== -->

<div class="disciplinas">
<div class="top-disciplinas"><?php echo WORDING_AVAILABLE_COURSES?></div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">
                

            <?php
                // Exibir todas as disciplinas disponiveis e permitir cadastros nas mesmas
                $listaDisciplina = array();
                                
                $listaDisciplina[0] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'nomeDisciplina');
                $listaDisciplina[1] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'nomeCurso');
                $listaDisciplina[2] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'descricao');
                $listaDisciplina[3] = $disciplina->getUserDisciplinas($_SESSION['user_id'], 'id');
                $contador = count($listaDisciplina[0]);
                //Imprime o nome de cada disciplina
                //print_r($listaDisciplina[0]);
                for($i=0; $i<$contador;$i++){
                    echo
                        "<li class='disciplinas-item'>".
                            "<div class='disciplina-item-content'>".
                                "<div class='lista-disciplina'>".
                                    "<h3>".$listaDisciplina[0][$i][0]."</h3>".
                                    "<h4>".$listaDisciplina[1][$i][0]."</h4>".
                                    "<p>".$listaDisciplina[2][$i][0].
                                    "<br>".
                                    "<br><a href='#openModalDeleteDisciplina' id=".$listaDisciplina[3][$i][0]." onClick='getDisciplinaId(this.id)'>Excluir</a>".
                                "</div>".
                            "</div>".
                            "<div style='float: right; width: 30%; text-align: right;'>".
                                "<form method='post' action='editar_disciplina.php' name='senha_disciplina'>".
                                    "<input type='hidden' id='idDisciplina' name='idDisciplina' value=".$listaDisciplina[3][$i][0]." />".
                                    "<input type='submit' name='editar_disciplina.php' action='' value='Ver Disciplina' />".
                                "</form>".
                                "<div class='button'>".
                                "<form action='cadastro_disciplina_cha_teste.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                   "<input type='hidden' name='disc' value='".$listaDisciplina[3][$i][0]."'>".
                                    "<input type='submit' value='Testar Recomendação'></br></br>".
                                    "</form>".
                                "</div>".
                            "</div>".
                        "</li>";
                
                ?>


                <div id="openModalDeleteDisciplina" class="modalDialog">
                        <div>
                            <a href="#close" title="Close" class="close">X</a>
                            <div class="top-cadastro"><?php echo 'Excluir disciplina?'; ?></div>
                                <!-- form action="home.html"--><!--action é só para mostrar, no site em si não tem isso"-->
                                <!--form method="post" action="register.php" name="registerform" -->
                                <form method="post" action="" name="">
                                    <a href="#close" class='botao-cadastra' title="Cancelar" class="close">Cancelar</a> 
                                    <input type="submit" name="" action="" value="<?php echo 'Deletar'; ?>" />

                                </form>                                                 

                        </div>
                        <!-- /.top-cadastro -->
                </div>
                <?php } ?>
                <!-- /.modalDialog -->
            </ul>
         </div>  

</div>



