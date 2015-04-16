<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	
    <title>Recoacomp</title>




    <!-- Importação do Jquery -->
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/growl.js"></script>
    <script src="jquery.bootstrap.wizard.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
    <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
    <script src="js/bootstrap-tagsinput-angular.js"></script>
    <script src="js/bootstrap-tagsinput.js"></script>
    <!-- Picklist cadastro de disciplinas -->
    <script src="js/picklist.js"></script>
    <script src="js/primeui-1.0.js"></script>
    
    <!-- Fim importação Jquery -->
	<!-- Login -->

	<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="prettify.css" rel="stylesheet">

    <!-- Loader do cadastro de OA CSS -->
    <link href="css/cadastro_OA.css" rel="stylesheet">
    <link href="css/progress_cadastro_OA.css" rel="stylesheet">
    <!-- Growl das mensagens de cadastros -->
    <link href="css/growl.css" rel="stylesheet">
    <!-- Seletor das palavras-chaves -->
    <link href="css/bootstrap-tagsinput.css" rel="stylesheet">
    <!-- Picklist cadastro de disciplinas -->
    <link href="css/picklist.css" rel="stylesheet">
    <link href="css/primeui-1.0.css" rel="stylesheet">
    <link href="css/theme.css" rel="stylesheet">

    <!-- Custom CSS Login Page-->
    <link href="css/landing-page.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/landing-page-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/landing-page-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/landing-page-large.css' />

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
	<!-- Fim Login -->
	
</head>
<body>
    <!-- ============== HEADER ============== -->
<header class="header-large">
    <a href="index.php" id="logo"></a> <!--muda quando o usuario estiver logged in e leva para o home.html"-->
        <nav >

            <a href="#" id="menu-icon"></a>

            <ul>

            <li><a href="#">Tutorial</a></li> <!--muda quando o usuario estiver logged in e leva para o home.html"-->
            <li><a href="#">Sobre</a></li>
            <li><a href="contato.php">Contato</a></li>
            <li><a href="equipe.php">Equipe</a></li>
<?php
if (isset($login)) {
if ($login->isUserLoggedIn() == true) {
?>
            <li><a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a></li>
<?php
}
}
?>
            </ul>

        </nav>

</header>



<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo"<script type='text/javascript'>";

            echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo"<script type='text/javascript'>";

            echo "alert('".$message."');";

            echo "</script>";
        }
    }
}?>

<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo"<script type='text/javascript'>";

            echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo"<script type='text/javascript'>";

            echo "alert('".$message."');";

            echo "</script>";
        }
    }
}
?>

<?php
// mostra erros do cadastro de disciplinas
if (isset($disciplina)) {
    if ($disciplina->errors) {
        foreach ($disciplina->errors as $error) {
            echo"<script type='text/javascript'>";

                echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($disciplina->messages) {
        foreach ($disciplina->messages as $message) {
            echo"<script type='text/javascript'>";

                echo "alert('".$message."');";

            echo "</script>";
        }
    }
}
?>

<?php
// mostra erros do cadastro de competencias
if (isset($competencia)) {
    if ($competencia->errors) {
        foreach ($competencia->errors as $error) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($competencia->messages) {
        foreach ($competencia->messages as $message) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$message."');";

            echo "</script>";
        }
    }
}
?>

<?php
// mostra erros do cadastro de OAS
if (isset($OA)) {
    if ($OA->errors) {
        foreach ($OA->errors as $error) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$error."');";

            echo "</script>";
        }
    }
    if ($OA->messages) {
        foreach ($OA->messages as $message) {
                        echo"<script type='text/javascript'>";

                echo "alert('".$message."');";

            echo "</script>";
        }
    }
}
?>