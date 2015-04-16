<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recoacomp</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/contato.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/contato-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/contato-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/contato-large.css' />

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="fixedBackgroundGradient"></div>

<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 07/10/14
 * Time: 15:49
 */

require_once("classes/email.php");
require_once("classes/Registration.php");
?>

<!-- ============== HEADER ============== -->
<?php include("_header.php"); ?>


<!-- ============== JANELINHA ============== -->

<div class="disciplinas">
        <div class="top-disciplinas"><div style="width: 50%; float: left; text-align: left">Contato</div><div  style="width: 50%; float: right; text-align: right; padding-top: 7px; padding-right: 10px;" ><a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a></div></div>
            <div class="disciplinas-content">
                <?php if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST["contato"])){ ?>  
                <form method="post" action="contato.php" name="contato">
                    <h4>Entre em contato com a nossa equipe</h4>
                    <p>Nos mande uma mensagem com suas perguntas, comentários e feedback.</p></br></br>
                    <input type="text" name="nome" placeholder="Nome"></br></br>
                    <input type="email" name="email" placeholder="E-mail"></br></br>
                    <textarea name="mensagem" style="width:100%;" placeholder="Escreva a sua mensagem aqui"></textarea></br></br>
                    <input type="submit" style="width: 150px; text-align: center" name="contato" value="Enviar"></br></br>
                </form>
                <?php } else{
                            $nome=$_POST["nome"];
                            $email=$_POST["email"];
                            $mensagem=$_POST["mensagem"];

                            $sendEmail = new Email();
                            $confirmacao = $sendEmail->sendContact($nome, $email, $mensagem);

                            if($confirmacao){
                                echo "Em breve entraremos em contato";
                            }else{
                                echo"Ouve um erro ao enviar a mensagem";
                            }

                        //}
                    }?>
            </div>
</div>

</body>

</html>
