<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 07/10/14
 * Time: 15:49
 */

require_once("../classes/email.php");
require_once("../classes/Registration.php");
?>
<?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["solicprof"])){ ?>
<form method="post" action="" name="solicprof">
    <label for="pedido"><Digite o motivo pelo qual você deseja ter acesso como professor.></label>
    <textarea name="pedido" ROWS="5" COLS="40"></textarea>


    <input type="submit" name="solicprof" value= "Solicitar para ser professor" />
    <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

</form><hr/>
<?php } else{

    //if( isset( $_POST["solicprof"] ) ){

        $campo=$_POST["pedido"];

        $sendEmail = new Email();
        $confirmacao = $sendEmail->sendProfessorEmail($campo);

        if($confirmacao){
            echo "funcionou";
        }else{
            echo"nooope";
        }

    //}
}?>