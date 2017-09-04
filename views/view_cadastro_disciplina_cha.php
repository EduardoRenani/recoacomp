<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');

?>
<!-- IMPORTAÇÃO JQUERY-->
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <link href="css/base_cadastro.css" rel="stylesheet">
    <link href="css/home-large.css" rel="stylesheet">
    <link href="css/jquery.nouislider.min.css" rel="stylesheet">

    <style>
  .tooltip {
    display: block;
    position: absolute;
    border: 1px solid #D9D9D9;
    font: 400 12px/12px Arial;
    border-radius: 3px;
    background: #fff;
    top: -43px;
    padding: 5px;
    left: -9px;
    text-align: center;
    width: 50px;
}
.tooltip strong {
    display: block;
    padding: 2px;
}

    body { font-size: 62.5%; }
    label, input { display:block; }
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
    <script src="js/jquery.nouislider.all.min.js" type="text/javascript"></script>

    <!-- FUNÇÃO QUE FAZ O SORTABLE E ENVIA OS ID'S DAS COMPETÊNCIAS-->
    <script>



    $(function(){


        function setText( value, handleElement, slider ){
            $("#exemplo").text( value );
        }
        $("#exemplo").Link('lower').to($("#value"), "text");

        $("#exemplo").Link('lower').to('-inline-<div class="tooltip"></div>', function ( value ) {

            // The tooltip HTML is 'this', so additional
            // markup can be inserted here.
            $(this).html(
                '<strong>Value: </strong>' +
                '<span>' + value + '</span>'
            );
        });

    });
</script>
</head>


<div class="fixedBackgroundGradient"></div>

<div class="cadastrobase">
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_FILL_YOUR_CHA); ?></div><div class="text-right" ><a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a></div></div>
        <div class="cadastrobase-content">
            <?php
                if(isset($_GET['redirecionar'])) { 
                    echo '<form method="post" action="recomendacao.php?codTipoUsuario='.$_GET["codTipoUsuario"].' name="cadastrar_usuario_disciplina" id="cadastrar_usuario_disciplina">';
                }
                else {
                    echo '<form method="post" action="disciplinas.php" name="cadastrar_usuario_disciplina" id="cadastrar_usuario_disciplina">';
                }
            ?>
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="idDisciplina" value="<?php echo $_POST['idDisciplina']; ?>" />
            <input type="hidden" name="okay" value="okay" />
            <input type="hidden" name="senha" value="<?php echo $_POST['senha']; ?>" />

            <label>
            <h2>Importante: os dados aqui informados serão utilizados para a recomendação</h2><br>
            <h4>
            Indicar um valor de 0 a 4, que represente o quanto esta disciplina irá abordar os conhecimentos, habilidades e atitudes de cada competência cadastrada:<br>
            0. Não desenvolvi<br>
            1. Desenvolvi em nível inicial<br>
            2. Desenvolvi em nível básico<br>
            3. Desenvolvi em nível intermediário<br>
            4. Desenvolvi em nível avançado<br>
            </h4>
            </label>
            <?php
                $instrumentos = $disciplina->getInstrumentos($_POST['idDisciplina']);
                if(sizeof($instrumentos) != 0) {
			foreach ($instrumentos as $instrumento) {
                    echo "<input type='hidden' name='competencias[]' value='".$instrumento['idcompetencia']."'>";
                    echo "<input type='hidden' name='idinstrumentos[]' value='".$instrumento['id']."'>";
                    echo "<li class='disciplinas-item' style='text-align: left;'>";
                    echo "<div class='disciplina-item-content'>";
                    echo "<h2>Competência: ".$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome']."</h2>";
                    echo "<h4>Situação problema:</h4>";
                    if(!$disciplina->checkMeio($_POST['idDisciplina']) && !$disciplina->checkFim($_POST['idDisciplina'])) {
                        echo "<input type='hidden' name='num_problema' value='1'>";
						echo "<h4>".$instrumento['problema_um']."</h4>";
                    }
                    else if($disciplina->checkMeio($_POST['idDisciplina'])) {
                        echo "<input type='hidden' name='num_problema' value='2'>";
						echo "<h4>".$instrumento['problema_dois']."</h4>";
					}
					else {
                        echo "<input type='hidden' name='num_problema' value='3'>";
						echo "<h4>".$instrumento['problema_tres']."</h4>";
					}
					echo "<br><h5>Com relação a esta situação, aponte seus conhecimentos, habilidades e atitudes.</h5>";
                    echo "<h5>Competência</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='0'> Não possuo</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='1'> Tenho noção, mas ainda tenho dúvidas</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='2'> Tenho noções básicas</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='3'> Não tenho plena certeza</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='4'> Tenho plena certeza</h5>";
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
		}
		else {
            ?>


            <?php
                //echo $_POST["idDisciplina"];
                $arrayIdCompetencias = $disciplina->getCompetenciaFromDisciplinaById($_POST["idDisciplina"]);

                foreach ($arrayIdCompetencias as $competenciaId) {

                    echo "<input type='hidden' id='arrayCHA' name='competencias[]' value=".$competenciaId[0]." />";

                    $nomeCompetencia = $competencia->getArrayOfNamesById($competenciaId[0]);

                    echo "<h2>Competência: " . $nomeCompetencia[0][0]."</h2>
                    <br>
                    <h4>Conhecimento</h4>
                    <input type='number' name='conhecimento[".$competenciaId[0]."]' min='0' max='4' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                    <br>
                    <h4>Habilidade</h4>
                    <input type='number' name='habilidade[".$competenciaId[0]."]' min='0' max='4' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                    <br>
                    <h4>Atitude</h4>
                    <input type='number' name='atitude[".$competenciaId[0]."]' min='0' max='4' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                    <br>";
                }
		}

            ?>
            <br>
            <input type="submit" name="verifica_senha" value="<?php echo WORDING_FINALIZE; ?>" />


</form>






        </div>
</div>



<?php include('_footer.php'); ?>