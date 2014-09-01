<!DOCTYPE html>
<html>
<head><title>Pagina Inicial</title></head>
<body>

    <?php
    /**
     * Created by PhpStorm.
     * User: Cláuser-PC
     * Date: 30/08/14
     * Time: 00:14
     */
    //require_once e include
    require_once("../Classes/usuario.php");

    //inicia sessão
    session_start();
    //verifica se há um usuário logado.
    //se não, armazena que não está logado.
    //se sim, copia a instancia da classe Usuario
    $logado = Usuario::isLogado();

    if($logado){
        $pessoa = unserialize($_SESSION["usuario"]);
        echo "Ola ".$pessoa->getNome()." tudo bem?<br />";
        echo "<a href='../Login/logout.php'>Logout</a>";
    }else{
        echo "Ola, Cadastre-se ou faca Login :D<br />";
        echo "<a href='../Login/cadastrar.html'>Cadastre-se</a><br /><a href='../Login/login.html'>Login</a>";
    }
    ?>
<!--
    <a href="../Login/cadastrar.html">Cadastre-se</a><br />
    <a href="../Login/login.html">Login</a>
    <a href="../Login/logout.php">Logout</a>
-->
</body>
</html>