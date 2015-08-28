<?php include('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

<!-- Home -->

<!-- Custom CSS -->
<link href="css/home.css" rel="stylesheet">
<link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
<link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
<link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />

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
                     <a href="disciplinas.php">
                     	<li class="active">
                        Minhas Disciplinas
                    	</li>
                	</a>
                   <a href="profile_show.php">
                   	<li>
                        Meu Perfil
                    </li>
                	</a>
                    <a href="disciplinas_disponiveis.php">
                    	<li style="z-index:1000;" id="home">
                        	Disciplinas Disponíveis
                    	</li>
                    </a>
    		
       						<?php
							if ($_SESSION['acesso'] == 1)
								include('_options_aluno.php'); 
								//echo WORDING_USER_STUDENT . "<br />";
							else if ($_SESSION['acesso'] == 2) {
                                if(isset($_POST['codTipoUsuario'])){
                                    $tipoUsuario = $_POST['codTipoUsuario'];
                                    if (($tipoUsuario  == 1) && ($_SESSION['acesso'] == 2)){
                                        echo '
                                            <form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
                                                <select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
                                                    <option value="" selected>Ver como...</option>
                                                    <option value="1">Aluno</option>
                                                    <option value="2">Professor</option>
                                                </select>
                                            </form>';
                                    }else{?>
                                        <a href="cadastro_OA.php">
                                            <li>
                                                <?= WORDING_REGISTER_NOVO_OA; ?>
                                            <br>                    
                                            </li>
                                        </a>
                                        <a href="cadastro_disciplina.php">
                                            <li>
                                                <?= WORDING_REGISTER_NOVA_DISCIPLINA; ?>
                                            </li>
                                        </a>
                                        <form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
                                                    <select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
                                                        <option value="" selected>Ver como...</option>
                                                        <option value="1">Aluno</option>
                                                        <option value="2">Professor</option>
                                                    </select>
                                        </form>
                                    <?php
                                    } // end if
                                    ?>


                                    
                                
                            <!--li-->

                            
                            <!--/li-->

                        <?php
                            //include('_options_professor.php'); 
                            //echo WORDING_USER_PROFESSOR . "<br/>";
                        }elseif(!(isset($_POST['codTipoUsuario']))){ ?>
                            <a href="cadastro_OA.php">
                                <li>
                                    <?= WORDING_REGISTER_NOVO_OA; ?>
                                <br>                    
                                </li>
                            </a>
                            <a href="cadastro_disciplina.php">
                                <li>
                                    <?= WORDING_REGISTER_NOVA_DISCIPLINA; ?>
                                </li>
                            </a>
                            <form method="post" action="#" id="tipoUsuario" name="tipoUsuario">
                                        <select name="codTipoUsuario" onchange ="this.form.submit()" onfocus="this.selectedIndex = -1;"> <!-- -->
                                            <option value="" selected>Ver como...</option>
                                            <option value="1">Aluno</option>
                                            <option value="2">Professor</option>
                                        </select>
                            </form>
                        <?php
                        }
                        else if($_SESSION['acesso'] == 3)
                            echo WORDING_USER_ADMIN . "<br/>";
                        }// End isset?>





                    </ul>
    	</div>  
</div>