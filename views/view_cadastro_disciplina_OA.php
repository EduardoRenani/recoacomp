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
<h2><?php echo (WORDING_CREATE_DISCIPLINA); ?> PARTE 2</h2>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN;?></a>
   <form method="post" action="" name="registrar_nova_disciplina_passo_um">
        <label for="nomeCurso"><?php echo WORDING_COURSE_NAME; ?></label>
        <input id="nomeCurso" type="text" name="nomeCurso" pattern="[a-zA-Z0-9]{2,64}" required />
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />


        



        
        <br /><br />

        <input type="submit" name="registrar_nova_disciplina_passo_um" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>




<?php include('_footer.php'); ?>