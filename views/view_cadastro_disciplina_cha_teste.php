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
            <div class="info-cadastro"><?php echo TEXT_CHA;?> <?php echo HINT_CHA;?></div>
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
                            <input type='number' name='conhecimento[".$competenciaId[0]."]' min='0' max='5' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                        </div>
                        
                        <div class='cha-escolha'>
                            <label for='nomeCompetencia' title='".$descricaoHabilidade['habilidade_descricao']."'><h4>Habilidade  <span class='tooltiploco' style='color: black'>[ ? ]</span></h4></label>
                        
                            <br>
                            <input type='number' name='habilidade[".$competenciaId[0]."]' min='0' max='5' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                        </div>

                        
                        <div class='cha-escolha'>
                            <label for='nomeCompetencia' title='".$descricaoAtitude['atitude_descricao']."'><h4>Atitude  <span class='tooltiploco'>[ ? ]</span></h4></label>
                            <br>
                            <input type='number' name='atitude[".$competenciaId[0]."]' min='0' max='5' value='0' oninput='this.form.conhecimento".$competenciaId[0].".value=this.value' />
                        </div>
                      
                    ";
                }
                                 
            ?>
            <br>
            <input type="submit" name="verifica_senha" value="<?php echo WORDING_TEST_REC; ?>" />


</form>


               

                

        </div>
</div>



<?php include('_footer.php'); ?>