<?php
/**
 * Created by PhpStorm.
 * User: Clauser-PC
 * Date: 30/08/14
 * Time: 00:41
 *
 * Lembrando que as variáveis de sessão são:
 * $_SESSION["usuario"]
 * $_SESSION['dt_hora_logon']
 *
 */

//require_once e include
require_once("../Classes/usuario.php");

//Inicia sessão
session_start();

//Se houver sessão ativa, destrói a mesma
if(isset($_SESSION["usuario"],$_SESSION['dt_hora_logon'])){
    unset($_SESSION['usuario']);
    unset($_SESSION['dt_hora_logon']);
}
session_destroy();

header("Location: ../Paginas/index.php");
exit;

?>