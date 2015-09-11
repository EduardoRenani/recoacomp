<?php include('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

<!-- Home -->

<!-- Custom CSS -->
<link href="css/home.css" rel="stylesheet">
<link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
<link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
<link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<!-- Custom Fonts -->
<link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

<!-- Fim Home -->

    <script type="text/javascript">
    //$(function() {
        function submitVisao(){
            //document.getElementById('tipoUsuario').submit();
            $("#tipoUsuario").submit();
            //var selectBox = document.getElementById("tipoVisao");
            //$( "#tipoVisao" ).val();
            //var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        }
    </script>

</head>
<?php

?>
<div class="sidebar"> 
	<div class="top-sidebar">Bem Vindo, <?php echo $_SESSION['user_name']?></div>
        <div class="sidebar-content">           
                <ul class="sidebar-menu">
                    <?php 
                        if ($_SESSION['acesso'] == 1){
                            include('_options_aluno.php');
                        }
                        elseif($_SESSION['acesso'] == 2){
                            include('_options_professor.php');
                        }
                        else if($_SESSION['acesso'] == 3){
                            echo WORDING_USER_ADMIN . "<br/>";
                        }
                    ?>
                </ul>
    	</div>  
</div>