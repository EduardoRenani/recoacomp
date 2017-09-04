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

    <!-- BREADCRUMB BONITO-->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script type="text/javascript">
        $(function() {
            $( document ).tooltip();
        });
</script>

</head>


<div class="fixedBackgroundGradient"></div>

<div class="cadastrobase">
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_FILL_TEST_CHA); ?></div><div class="text-right" ><a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a></div></div>
        <div class="cadastrobase-content">
            <form method="post" action="recomendacao_teste.php" name="cadastrar_usuario_disciplina" id="cadastrar_usuario_disciplina" style="padding-left: 10%;">
            <input type="hidden" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION['user_id']; ?>" />
            <input type="hidden" name="disc" value="<?php echo $_POST['disc']; ?>" />
            <input type="hidden" name="okay" value="okay" />
            <div class="info-cadastro"><?php echo HINT_CHA."<br>".HINT_CHA_0."<br>".HINT_CHA_1."<br>".HINT_CHA_2."<br>".HINT_CHA_3."<br>".HINT_CHA_4;?></div>
            <?php
                $instrumentos = $disciplina->getInstrumentos($_POST['disc']);
                if(sizeof($instrumentos) != 0) {
			foreach ($instrumentos as $instrumento) {
                    echo "<input type='hidden' name='competencias[]' value='".$instrumento['idcompetencia']."'>";
                    echo "<input type='hidden' name='idinstrumentos[]' value='".$instrumento['id']."'>";
                    echo "<li class='disciplinas-item' style='text-align: left;'>";
                    echo "<div class='disciplina-item-content'>";
                    echo "<h2>Competência: ".$competencia->getNomeCompetenciaById(intval($instrumento['idcompetencia']))[0]['nome']."</h2>";
                    echo "<h4>Situação problema:</h4>";
                    if(!$disciplina->checkMeio($_POST['disc']) && !$disciplina->checkFim($_POST['disc'])) {
                        echo "<input type='hidden' name='num_problema' value='1'>";
                        echo "<h4>".$instrumento['problema_um']."</h4>";
                    }
                    else if($disciplina->checkMeio($_POST['disc'])) {
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
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='1'> Tenho Noção, mas ainda tenho dúvidas</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='2'> Tenho noções básicas</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='3'> Não tenho plena certeza</h5>";
                    echo "<h5><input type='radio' name='conhecimento[".$instrumento['idcompetencia']."]' value='4'> Tenho plena certeza</h5>";
                    echo "<br><h5>Habilidade</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='0'> Não possuo</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='1'> Tenho Noção, mas ainda tenho dúvidas</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='2'> Tenho noções básicas</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='3'> Não tenho plena certeza</h5>";
                    echo "<h5><input type='radio' name='habilidade[".$instrumento['idcompetencia']."]' value='4'> Tenho plena certeza</h5>";
                    echo "<br><h5>Atitude</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='0'> Não possuo</h5>";
                    echo "<h5><input type='radio' name='atitude[".$instrumento['idcompetencia']."]' value='1'> Tenho Noção, mas ainda tenho dúvidas</h5>";
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
                $arrayIdCompetencias = $disciplina->getCompetenciaFromDisciplinaById($_POST["disc"]);

                foreach ($arrayIdCompetencias as $competenciaId) {

                    echo "<input type='hidden' id='arrayCHA' name='competencias[]' value=".$competenciaId[0]." />";
                    $descricaoCompetencias = $competencia->getDescricaoCompetenciaById($competenciaId[0]);
                    $nomeCompetencia = $competencia->getArrayOfNamesById($competenciaId[0]);
                    $descricaoConhecimento = $competencia->getDescricaoConhecimentoById($competenciaId[0]);
                    $descricaoHabilidade = $competencia->getDescricaoHabilidadeById($competenciaId[0]);
                    $descricaoAtitude = $competencia->getDescricaoAtitudeById($competenciaId[0]);
                    echo "<label for='nomeCompetencia' title='".$descricaoCompetencias['descricao_nome']."'>


                        <h2>Competência: " . $nomeCompetencia[0][0]."  <span class='tooltiploco'>[ ? ]</span></h2></label>

                        <div class='cha-escolha'>
                            <label for='nomeCompetencia' title='".$descricaoConhecimento['conhecimento_descricao']."'><h4>Conhecimento  <span class='tooltiploco' style='color: black'>[ ? ]</span></h4></label>
                            <br>
                            <input type='number' name='conhecimento[".$competenciaId[0]."]' min='0' max='4' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
						</div>

                        <div class='cha-escolha'>
                            <label for='nomeCompetencia' title='".$descricaoHabilidade['habilidade_descricao']."'><h4>Habilidade  <span class='tooltiploco' style='color: black'>[ ? ]</span></h4></label>

                            <br>
                            <input type='number' name='habilidade[".$competenciaId[0]."]' min='0' max='4' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                        </div>


                        <div class='cha-escolha'>
                            <label for='nomeCompetencia' title='".$descricaoAtitude['atitude_descricao']."'><h4>Atitude  <span class='tooltiploco'>[ ? ]</span></h4></label>
                            <br>
                            <input type='number' name='atitude[".$competenciaId[0]."]' min='0' max='4' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                        </div>

                    ";
                	}
		}
            ?>
            <br>
            <input type="submit" name="verifica_senha" value="<?php echo WORDING_TEST_REC; ?>" />


</form>






        </div>
</div>



<?php include('_footer.php'); ?>