<?php
/**
 * Created by PhpStorm.
 * User: claus_000
 * Date: 10/09/14
 * Time: 09:33
 */

include('_header.php');
require_once("classes/OA.php");?>


    <!-- clean separation of HTML and PHP -->
    <h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

    <!-- formulario para cadastro de OAS -->
    <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
    <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["cadastro_OA_categoria_geral"])){ ?>
    <form method="post" action="" name="cadastro_OA_categoria_geral">
    <!-- DADOS GERAIS -->
    <b><?php echo WORDING_GENERAL_INFORMATION; ?></b>
    <br><br>

    <!-- ID USUÁRIO -->
    <input type="hidden" id="idusuario" name="idusuario" value="<?php echo $_SESSION['user_id']; ?>" />

    <!-- DESCRIÇÃO -->
    <label for="descricao"><?php echo WORDING_DESCRIPTION; ?></label>
    <textarea name="descricao" ROWS="5" COLS="40"></textarea>
    <br><br>

    <!-- NOME -->
    <label for="nome"><?php echo WORDING_NAME; ?></label>
    <input id="nome" type="text" name="nome" required />
    <br><br>

    <!-- URL -->
    <label for="url"><?php echo WORDING_URL; ?></label>
    <input id="url" type="text" name="url" required />
    <br><br>

    <!-- PALAVRA CHAVE -->
    <label for="palavrachave"><?php echo WORDING_KEYWORDS; ?></label>
    <input id="palavrachave" type="text" name="palavrachave" required />

    <!-- IDIOMA -->
    <label><?php echo WORDING_LANGUAGE; ?></label>
    <select id = "idioma" name="idioma" required="true">
        <option value = "espanhol"><?php echo WORDING_SPANISH ?></option>
        <option value = "ingles"><?php echo WORDING_ENGLISH ?></option>
        <option value = "portugues"><?php echo WORDING_PORTUGUES ?></option>
    </select>
    <br><br>

    <input type="submit" action="views/view_cadastro_OA_categoria_direito" name="cadastro_OA_categoria_geral" value="<?php echo WORDING_CREATE_OA ; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>

<?php } else{
        $idusuario=$_POST["idusuario"];
        $descricao=$_POST["descricao"];
        $nome=$_POST["nome"];
        $url=$_POST["url"];
        $palavrachave=$_POST["palavrachave"];
        $idioma=$_POST["idioma"];

        //$OA  = new OA();
        //$sendEmail = new Email();
        //$confirmacao = $sendEmail->sendProfessorEmail($campo);

        if($confirmacao){
            echo "funcionou";
        }else{
            echo"nooope";
        }

    <!-- backlink -->
    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php');

?>