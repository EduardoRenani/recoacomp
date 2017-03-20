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
                $disciplinas_user = $disciplina->getUserDisciplinasByASC($_SESSION['user_id']);
                foreach ($disciplinas_user as $disciplina_user) {
                    if(!$disciplina->hasInstrumento($disciplina_user['iddisciplina'])) {
                        echo "<li class='disciplinas-item'>";
                        echo "<form action='criar_instrumento.php' method='POST'>";
                        echo "<input type='hidden' name='disciplina' value='".$disciplina_user['iddisciplina']."'>";
                        echo "<div class='disciplina-item-content'>";
                        echo "<h3>".$disciplina_user['nomeDisciplina']."</h3>";
                        $competencias_disciplina = $disciplina->getCompetenciasDisciplina($disciplina_user['iddisciplina'], 'idDisciplina');
                        foreach ($competencias_disciplina as $competencia_disciplina) {
                            echo "<h4><input style='height: auto;' type='checkbox' name='competencias[]' value='".$competencia_disciplina['competencia_idcompetencia']."' checked>".$competencia->getNomeCompetenciaById($competencia_disciplina['competencia_idcompetencia'])[0]['nome']."</h4>";
                        }
                        echo "</div>";
                        echo "<div><input type='submit' value='Criar instrumento'></div>";
                        echo "</form></li>";
                    }
                }
            ?>
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
</div>