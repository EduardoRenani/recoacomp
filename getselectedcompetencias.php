<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 24/09/14
 * Time: 11:04
 */


    start_session();

    $_SESSION["selectedcompetencias"] = $_POST["sorted"];
    header("Location: ".HTTP_REFERER);

    exit;

?>