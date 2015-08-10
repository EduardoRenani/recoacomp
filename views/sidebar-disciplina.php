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
            document.getElementById('tipoUsuario').submit();
        }

		function mudaVisao(tipoVisao){
        	var selectBox = document.getElementById("tipoVisao");
    		var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    		//console.log(selectedValue);
    		//$.get("ajax/mudaVisao.php");
    		
    		//jQuery('#tipoVisao').load('ajax/mudaVisao.php?acesso=1');
    		//
    		//return false;
            //console.log(selectedValue);
            /*
            jQuery.ajax({
                url: 'ajax/mudaVisao.php',
                type: 'POST',
                data: {
                    tipoVisao: selectedValue,
                },
                //dataType : 'json',
                success: function(data, textStatus, xhr) {
                    console.log(data); // do with data e.g success message
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.log(textStatus.reponseText);
                }
            });
            location.reload();


*/

    		jQuery.ajax({
                type: "POST",
                url: "ajax/mudaVisao.php",
                data: { 
                    tipoUsuario : 1,
                },
                cache: false,
                // importantinho.
                error: function(e){
                    alert(e);
                },
                success: function(response){
                    console.log(response);
                }
            });
            //location.reload();
        };
	//});

    </script>

</head>

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
    				<a href="cadastro_disciplina.php">
    					<li>
	   						<?php 
							if ($_SESSION['acesso'] == 1)
								include('_options_aluno.php'); 
								//echo WORDING_USER_STUDENT . "<br />";
							else if ($_SESSION['acesso'] == 2){
								echo WORDING_REGISTER_NOVA_DISCIPLINA; ?>
                            <br>
						</li>
					</a>
					<a href="cadastro_OA.php">
						<li>
							<?= WORDING_REGISTER_NOVO_OA; ?>
                        <br>					
                        </li>
                	</a>

                    <?php
                        //include('_options_professor.php'); 
                        //echo WORDING_USER_PROFESSOR . "<br/>";
                    }else if($_SESSION['acesso'] == 3)
                        echo WORDING_USER_ADMIN . "<br/>";
                    ?>


                	<form method="post" action="index.php" id="tipoUsuario">
                	<select id='tipoVisao' onchange="submitVisao();"> <!-- -->
						<option value="1">Visão de aluno</option>
						<option value="2">Visão de professor</option>
					</select>
					</form>
                </ul>
    	</div>  
</div>