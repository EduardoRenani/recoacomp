<?php include('_header.php'); ?>

<!-- clean separation of HTML and PHP -->
<h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<?php
require_once("../Classes/disciplina.php");

// Receber dados do formulário

if( $_SERVER["REQUEST_METHOD"] == "POST"){

    $nomeCurso = $_POST['nomeCurso'];
    $nomeDisciplina = $_POST['nomeDisciplina'];
    $descricao = $_POST['descricao'];
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];
    $usuarioProfessorID = 0;

    if(!$_SESSION['SS_usuario_id']) //TODO SUBSTITUIR SS_usuario_id pela session correta
        session_start();
    try{
        $usuarioProfessorID = $_SESSION['SS_usuario_id']; //TODO SUBSTITUIR SS_usuario_id pela session correta
        $isProf = false;

        if($_SESSION['acesso'] >= 2)
            $isProf=true;
    }catch(Exception $e){
        echo "Exceção pega: ".  $e->getMessage(). "\n";
    }


    if($senha != $senha2){ //TODO substituir por função validaSenha(), ou algo assim...
        if(!$isProf){
            echo MESSAGE_YOU_SHOULDNT_BE_HERE."!";
            header('../Paginas/index.php');
            exit;
        }
        $disc = new Disciplina();
        $disc->criaDisc($nomeCurso, $nomeDisciplina, $descricao, $usuarioProfessorID, $senha);
    }


    //public function criaDisc($nomeCurso, $nomeDisciplina, $descricao, $usuarioProfessorID, $senha)

}else{

}
?>

<!-- formulario para cadastro de disciplinas -->
<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="" name="registrar_nova_disciplina">
    <!--$this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha']);-->
    <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
    <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
    <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="nomeDisciplina"><?php echo WORDING_DISCIPLINA_NAME; ?></label>
    <input id="nomeDisciplia" type="text" name="nomeDisciplina" pattern="[a-zA-Z0-9]{2,64}" required />

    <label for="senha"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
    <input id="senha" type="text" name="senha" required />

    <label for="senha2"><?php echo WORDING_REGISTRATION_PASSWORD; ?></label>
    <input id="senha2" type="text" name="senha2" required />

    <label for="descricao"><?php echo WORDING_DISCIPLINA_DESCRICAO; ?></label>
    <textarea name="descricao" ROWS="5" COLS="40"></textarea>


    <input type="submit" name="registrar_nova_disciplina" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

</form><hr/>



<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
