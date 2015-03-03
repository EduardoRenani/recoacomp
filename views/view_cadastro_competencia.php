<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php'); ?>

<head>

<script type="text/javascript">
    $(function() {
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            update: function(event, ui) {
            var arrayOAS = $("#tabela2").sortable('toArray').toString();
            document.getElementById('arrayOAS').value = arrayOAS;
            var order = $('#tabela1').sortable('serialize'); 
            $("#tabela1").load("process-sortable.php?"+order); 
            }
            });
        });

</script>
</head>
<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?></h2>
<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<!-- Se estiver na segunda fase da criação de competências, deve-se associar pelo menos UM (1) objeto -->
<form method="post" action="" name="registrar_nova_competencia">
    <h2> <?php echo WORDING_CREATE_COMPETENCA; ?></h2>
    <!-- $_POST['conhecimentoDescricao']-->
    <label for="nome"><?php echo WORDING_NAME; ?></label>
    <input id="nome" type="text" name="nome" required />
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"/>
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

    <input type="hidden" id="arrayOAS" name="arrayOAS" value="" />


        <ul id="tabela1">
            <?php
            $OA = new OA();
            $idOA = $OA->getArrayOfId_OA();
            $nomeOA = $OA->getArrayOfName_OA(); 
            $contador = count($nomeOA);
            // $idOA[$i] = posição no vetor
            // ["idcesta"] = parametro do banco de dados
            for($i=0;$i<$contador;$i++){ ?>
                <li id="<?php echo "".($idOA[$i]["idcesta"]); ?>" class="ui-state-default"><?php echo "".($nomeOA[$i]["nome"]); ?></li>
            <?php } ?>
        </ul>
        <ul id="tabela2">
        <!-- Os objetos que serão associados estarão nessa tabela -->
        </ul>

    <input type="submit" name="registrar_nova_competencia" value="<?php echo WORDING_CREATE_COMPETENCA; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAN; ?>" />


</form>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
<?php include('_footer.php'); ?>