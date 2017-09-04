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
                <form action='responder_instrumento.php' method='POST'>
                    <input type='hidden' name='responder_instrumento'>
                    <input type='hidden' name='iddisciplina' value="<?php echo $_POST['iddisciplina']; ?>">
            <?php
                $instrumentos = $disciplina->getInstrumentos($_POST['iddisciplina']);
                foreach ($instrumentos as $instrumento) {
                    echo "<input type='hidden' name='idcompetencias[]' value='".$instrumento['idcompetencia']."'>";
                    echo "<input type='hidden' name='idinstrumentos[]' value='".$instrumento['id']."'>";
                    echo "<li class='disciplinas-item' style='text-align: left;'>";
                    echo "<div class='disciplina-item-content'>";
                    echo "<h2>Competência: ".$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome']."</h2>";
                    echo "<h4>Situação problema:</h4>";
                    echo "<h4>".$instrumento['problema_um']."</h4>";
                    echo "<br><h5>Com relação a esta situação, aponte seus conhecimentos, habilidades e atitudes.</h5>";
                    echo "<h5>Competência</h5>";
                    echo "<h5><input type='radio' name='conhecimento".$instrumento['idcompetencia']."' value='0'> Não possuo</h5>";
                    echo "<h5><input type='radio' name='conhecimento".$instrumento['idcompetencia']."' value='1'> Tenho Noção, mas ainda tenho dúvidas</h5>";
                    echo "<h5><input type='radio' name='conhecimento".$instrumento['idcompetencia']."' value='2'> Tenho noções básicas</h5>";
                    echo "<h5><input type='radio' name='conhecimento".$instrumento['idcompetencia']."' value='3'> Não tenho plena certeza</h5>";
                    echo "<h5><input type='radio' name='conhecimento".$instrumento['idcompetencia']."' value='4'> Tenho plena certeza</h5>";
                    echo "<br><h5>Habilidade</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='0'> Não possuo</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='1'> Tenho noção, mas ainda tenho dúvidas</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='2'> Tenho noções básicas</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='3'> Não tenho plena certeza</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='4'> Tenho plena certeza</h5>";
                    echo "<br><h5>Atitude</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='0'> Não possuo</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='1'> Tenho noção, mas ainda tenho dúvidas</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='2'> Tenho noções básicas</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='3'> Não tenho plena certeza</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='4'> Tenho plena certeza</h5>";
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
                <input type="submit" value='Responder instrumento'>
                </form>
            </ul>
         </div>  
     </div>
</div>