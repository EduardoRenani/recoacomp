<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php'); ?>
<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?></h2>
<h2> <?php echo WORDING_CREATE_COMPETENCA; ?></h2>

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["registrar_nova_disciplina"])){ ?>
<form method="post" action="" name="registrar_nova_competencia">
    <!-- $_POST['conhecimentoDescricao']-->
    <label for="nome"><?php echo WORDING_NAME; ?></label>
    <input id="nome" type="text" name="nome" pattern="[a-zA-Z0-9]{2,64}" required />
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"
    <br>
    <label for="descricaoNome"><?php echo WORDING_COMPETENCIA_DESCRICAO; ?></label>
    <textarea name="descricaoNome" ROWS="5" COLS="40"></textarea>
    <br>
    <label for="atitudeDescricao"><?php echo WORDING_ATITUDE_DESCRICAO; ?></label>
    <textarea name="atitudeDescricao" ROWS="5" COLS="40"></textarea>
    <br>
    <label for="habilidadeDescricao"><?php echo WORDING_HABILIDADE_DESCRICAO; ?></label>
    <textarea name="habilidadeDescricao" ROWS="5" COLS="40"></textarea>
    <br>
    <label for="conhecimentoDescricao"><?php echo WORDING_CONHECIMENTO_DESCRICAO; ?></label>
    <textarea name="conhecimentoDescricao" ROWS="5" COLS="40"></textarea>
    <br>

    <input type="submit" name="registrar_nova_competencia" value="<?php echo WORDING_CREATE_COMPETENCA; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAN; ?>" />

</form><hr/>
<?php }else{
    $competencia = new Competencia();
    $oa = new OA(true);
    $idOA = $oa->getArrayOfIDs();

    $vectorSize=count($idOA);  //Contar fora do for evita 7 segundos de processamento a cada 1 milhão de iterações.
    //É o grande problema do uso de foreach

    for($i=0;$i<$vectorSize;$i++){
        //Se houver erro na associação de alguma copetência, o método associaCompetencia retorna false.
        //Caso contrário, ele associa a competência.
        if ($competencia->associaOA($idOA[$i]["idcesta"]) == false){
            //Erro na associação da OA $idOA[$i] com a competência sendo criada.
            echo (WORDING_CANT_ASSOCIATE_COMPETENCIA);
        }
    }

    ?>
<?php } ?>
<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>