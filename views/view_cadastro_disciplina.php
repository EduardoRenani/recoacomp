<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */
include('_header.php');

?>

<h2><?php echo ($_SESSION['user_name']); ?></h2>
<h2><?php echo (WORDING_CREATE_DISCIPLINA); ?></h2>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>

<?php if( $_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["registrar_nova_disciplina"])){ ?>

    <form method="post" action="" name="registrar_nova_disciplina">
        <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
        <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />

        <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
        <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

        <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
        <input id="senha" type="text" name="senha" required />

        <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
        <textarea name="descricao" ROWS="5" COLS="40"></textarea>
        <br />

        <ul id="sortable1" class="connectedSortable">
            <li class="ui-state-highlight">Item Inicial</li>
            <?php
            $comp = new Competencia();
            $idCompetencia = $comp->getArrayOfIDs();
            $nomeCompetencia = $comp->getArrayOfNames();
            $contador = count($nomeCompetencia);

            for($i=0;$i<$contador;$i++){ ?>
                <li class="ui-state-default"><?php echo "".($nomeCompetencia[$i]["nome"]); ?></li>
            <?php } ?>

        </ul>
        <ul id="sortable2" class="connectedSortable">
            <li class="ui-state-highlight">Item 1 selecionado</li>
            <li class="ui-state-highlight">Item 2 selecionado</li>
        </ul>
        <br /><br />

        <script>
            var sorted = $("#sortable2").sortable("toArray");
            function register(){
                $.ajax({
                    method: "post",
                    url: "getselectedcompetencias.php",
                    data: {sorted:sorted}
                });
            }
            //Isso aqui é php
            //session_start();
            //var_dump($_SESSION["selectedcompetencias"] );
        </script>
        <br /><br />

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>

<?php }

else{
    $disciplina = new Disciplina();
    //Gambiarra INICIO TODO
    //Da onde que instanciar uma classe é gambiarra? '-' SHAUSHAS
    $comp = new Competencia(true);
    $idCompetencia = $comp->getArrayOfIDs();
    //Gambiarra FINAL TODO

    if(count($disciplina->getErrors() == 0)){
        $disciplina_id = $disciplina->getID_byBD();

        $vectorSize=count($idCompetencia);  //Contar fora do for evita 7 segundos de processamento a cada 1 milhão de iterações.
        //É o grande problema do uso de foreach

        for($i=0;$i<$vectorSize;$i++){
            //Se houver erro na associação de alguma copetência, o método associaCompetencia retorna false.
            //Caso contrário, ele associa a competência.
            if ($disciplina->associaCompetencia($idCompetencia[$i]) == false){
                //Erro na associação da competência $idCompetencia[$i] com a disciplina sendo criada.
                echo (WORDING_CANT_ASSOCIATE_COMPETENCIA);
            }
        }

    }else{
        echo $disciplina->getMessage();
    }

}

?>

<?php include('_footer.php'); ?>