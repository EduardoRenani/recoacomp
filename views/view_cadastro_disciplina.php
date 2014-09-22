<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 11/09/14
 * Time: 14:32
 */

 include('_header.php'); ?>

<!-- IMPORTAÇÃO JQUERY-->
<head>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="/resources/demos/style.css">
    <style>
        #sortable1, #sortable2 {
            border: 1px solid #eee;
            width: 142px;
            min-height: 20px;
            list-style-type: none;
            margin: 0;
            padding: 5px 0 0 0;
            float: left;
            margin-right: 10px;
        }
        #sortable1 li, #sortable2 li {
            margin: 0 5px 5px 5px;
            padding: 5px;
            font-size: 1.2em;
            width: 120px;
        }
    </style>
    <script>
        $(function() {
            $( "#sortable1, #sortable2" ).sortable({
                connectWith: ".connectedSortable"
            }).disableSelection();
        });
    </script>
</head>
<!-- FIM IMPORTAÇÃO JQUERY-->

<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?></h2>
<h2> <?php echo WORDING_CREATE_DISCIPLINA; ?></h2>



<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<?php
if( $_SERVER["REQUEST_METHOD"] != "POST"){ ?>
    <form method="post" action="view_cadastro_disciplina.php" name="registrar_nova_disciplina">
        <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
        <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>"

        <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
        <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

        <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
        <input id="senha" type="text" name="senha" required />

        <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
        <textarea name="descricao" ROWS="5" COLS="40"></textarea>

        <ul id="sortable1" class="connectedSortable">
            <?php

            //TODO Retornar competencias com getListaCompetencia() e fazer um for para listagem

            if(true){?>
                <li class="ui-state-default">Item 1</li>
            <?php } ?>
        </ul>

        <ul id="sortable2" class="connectedSortable">
            <li class="ui-state-highlight">Item 1</li>
            <li class="ui-state-highlight">Item 2</li>
            <li class="ui-state-highlight">Item 3</li>
            <li class="ui-state-highlight">Item 4</li>
            <li class="ui-state-highlight">Item 5</li>
        </ul>

        <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>
<?php}

else{
    //TODO Apagar atribuições comentadas abaixo se funcionar direto por session
    /*
    $nomeCurso=$_POST['nomeCurso'];
    $nomeDisciplina=$_POST['nomeDisciplina'];
    $senha=$_POST['senha'];
    $descricao=$_POST['descricao'];
    */

    //TODO Fazer com que o vetor deixe de ser apenas uma suposição e se torne uma entrada, de preferência, por session
    //Vamos supor:
    //              Que possuo um vetor de IDs de competências que devem ser associadas à disciplina sendo criada.
    $idCompetencia = array();
    $idCompetencia = [1,2,3,4,5];
    //Como gerar esse vetor deve ser estudado quando colocarmos JQuery para selecionar as competências.

    $disciplina = new Disciplina();
    if(strlen($disciplina->getErrors() == 0)){
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




<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<a href=""><?php echo WORDING_CREATE_NEW_COMPETENCIA; ?></a>
<?php
require_once("classes/conexao.php");
//$bd = new conexao()
$bd = new conexao('localhost','recomendador-test','root','root');

?>



<ul id="sortable1" class="connectedSortable">
    <li class="ui-state-default">Item 1</li>
    <li class="ui-state-default">Item 2</li>
    <li class="ui-state-default">Item 3</li>
    <li class="ui-state-default">Item 4</li>
    <li class="ui-state-default">Item 5</li>
</ul>
<br>
<ul id="sortable2" class="connectedSortable">
    <li class="ui-state-highlight">Item 1</li>
    <li class="ui-state-highlight">Item 2</li>
    <li class="ui-state-highlight">Item 3</li>
    <li class="ui-state-highlight">Item 4</li>
    <li class="ui-state-highlight">Item 5</li>
</ul>

<br>



<?php include('_footer.php'); ?>
