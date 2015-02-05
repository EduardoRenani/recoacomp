<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php'); 
require_once("classes/OA.php");?>

<head>
<style type="text/css">
        <style>
        #tabela1, #tabela2 {
            border: 1px solid #eee;
            width: 142px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 10px;
        }
        #tabela1 li, #tabela2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 120px;
        }
</style>
<script type="text/javascript">
    $(function() {
        $('#tabela1, #tabela2').sortable({
            connectWith: "#tabela1, #tabela2",
            update: function(event, ui) {
            var arrayCompetencias = $("#tabela2").sortable('toArray').toString();
            document.getElementById('arrayCompetencias').value = arrayCompetencias;
            }
            });
        });

</script>
</head>
<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?></h2>
<h2> <?php echo WORDING_CREATE_COMPETENCA; ?></h2>

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<!-- Se estiver na segunda fase da criação de competências, deve-se associar pelo menos UM (1) objeto -->
<?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["registrar_nova_competencia"])){ ?>
<form method="post" action="" name="registrar_nova_competencia">
    <!-- $_POST['conhecimentoDescricao']-->
    <label for="nome"><?php echo WORDING_NAME; ?></label>
    <input id="nome" type="text" name="nome" required />
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
    /** Segunda fase do cadastro de competência
        Associação dos objetos que já existem no banco de dados e/ou
        criação de um novo objeto.

        -> Se novo objeto: mostrar cadastro dos objetos
        -> Se apenas associar: terminar o cadastro da competência
    **/      
    ?>
   <div class="tab-pane" id="tab2">
        <input type="hidden" id="arrayCompetencias" name="arrayCompetencias" value="" />
        <ul id="tabela1">
            <?php
            $OA = new OA();
            $idOA = $OA->getArrayOfId_OA();
            $nomeOA = $OA->getArrayOfName_OA(); 
            $contador = count($nomeOA);
            for($i=0;$i<$contador;$i++){ ?>
                <li id="<?php echo "".($idOA[$i]["idOA"]); ?>" class="ui-state-default"><?php echo "".($nomeOA[$i]["nome"]); ?></li>
            <?php } ?>
        </ul>
        <ul id="tabela2">
        <!--<li class="ui-state-highlight">Item 1 selecionado</li>-->
        </ul>
        <button>Criar nova competência</button>
    </div>


<?php } ?>


<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>
<?php include('_footer.php'); ?>