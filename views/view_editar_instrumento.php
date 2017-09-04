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
    <div class="top-disciplinas"><?php echo "Atividade: ".$disciplina->getNomeDisciplinaById($_POST['iddisciplina'])[0]['nomeDisciplina']; ?></div>
        <div class="disciplinas-content">
            <ul class="disciplinas-list" style='text-align: center;'>
                <form action='editar_instrumento.php' method='POST'>
                    <input type='hidden' name='editar_instrumento'>
            <?php
				$instrumentos = $disciplina->getInstrumentos($_POST['iddisciplina']);
                foreach ($instrumentos as $instrumento) {
					echo "<input type='hidden' value='".$instrumento['id']."' name='idinstrumentos[]'>";
					echo "<li class='disciplinas-item' style='text-align: left;'>";
					echo "<div class='disciplina-item-content'>";
                    echo "<h2>Competência: ".$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome']."</h2>";
					echo "<h4>Primeira situação problema:</h4>";
					echo "<textarea name='problemasUm[]'>".$instrumento['problema_um']."</textarea>";
					echo "<h4>Segunda situação problema:</h4>";
					echo "<textarea name='problemasDois[]'>".$instrumento['problema_dois']."</textarea>";
					echo "<h4>Terceira situação problema:</h4>";
					echo "<textarea name='problemasTres[]'>".$instrumento['problema_tres']."</textarea>";
					echo "<div>";
					echo "</li>";
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
                <input type="submit" value='Editar instrumento'>
                </form>
            </ul>
         </div>  
     </div>
</div>