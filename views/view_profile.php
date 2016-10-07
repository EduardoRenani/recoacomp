<?php include_once('_header.php'); ?>
<?php include_once('libraries/gravatar.php'); ?>

<head>

    <title>Perfil</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    
    <link href="css/perfil.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/perfil-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/perfil-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/perfil-large.css' /> 

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script language="javascript">
        $(document).ready(function(){
            var icons = {
            //"header": "ui-icon-plus", "activeHeader": "ui-icon-minus"
            header: "ui-icon-plus",
            activeHeader: "ui-icon-minus"
            };
            $("#competencias").accordion({
                header: "> div > h3",
                active: false,
                collapsible: true,
                icons: icons,
                heightStyle: "content"
            });
        });
    </script>

</head>

<body>
    
    <div class="fixedBackgroundGradient"></div>
    <?php include("views/sidebar-profile.php"); ?>

<!-- ============== DADOS DO USUÁRIO ============== -->
<div class="disciplinas">
    <div class="top-disciplinas">Meu Perfil</div>
        <div class="meu-perfil-content">  </br> 
     		<div id="foto" style="float: left; width: 30%;">
		        <?php 
		            $foto = new Foto((int) $_SESSION['user_id']);
		            if(!is_null($foto->getCaminho())) echo "<img style='width: auto; height: 200px;' src='img/profile_images/".$foto->getNome()."'>";
		            else echo "<img style='width: auto; height: 200px;' src='img/profile_images/head.png'>";
		        ?>
		    </div>
     		<div id="biografia" style="float: right; width: 70%; text-align: left;">
	            <p class="subtitle">Nome: <?php echo $_SESSION['user_name']; ?></p></br>
	            <p class="subtitle">E-mail: <?php echo $_SESSION['user_email']; ?></p>
				<div id="competencias">
					<?php
						$competencia = new Competencia;
						$idCompetencias = $competencia->getArrayOfIDsByAluno($_SESSION['user_id']);
						foreach ($idCompetencias as $idCompetencia) {
							$nomeCompetencia = $competencia->getArrayOfNamesById($idCompetencia[0])[0];
							$cha = $competencia->getCHAbyAluno($idCompetencia[0], $_SESSION['user_id'])[0];
							if($nomeCompetencia) {
								echo 	'<div id="groups">
										<h3>'.$nomeCompetencia[0].'</h3>
										<div>
											<dl>';
											$chaConhecimento = "Sem dados";
                                            $chaHabilidade = "Sem dados";
                                            $chaAtitude = "Sem dados";
                                            if($cha) {
                                                switch($cha["conhecimento"]) {
                                                    case '0':
                                                        $chaConhecimento = HINT_CHA_0;
                                                        break;
                                                    case '1':
                                                        $chaConhecimento = HINT_CHA_1;
                                                        break;
                                                    case '2':
                                                        $chaConhecimento = HINT_CHA_2;
                                                        break;
                                                    case '3':
                                                        $chaConhecimento = HINT_CHA_3;
                                                        break;
                                                    case '4':
                                                        $chaConhecimento = HINT_CHA_4;
                                                        break;
                                                }
                                                switch($cha["habilidade"]) {
                                                    case '0':
                                                        $chaHabilidade = HINT_CHA_0;
                                                        break;
                                                    case '1':
                                                        $chaHabilidade = HINT_CHA_1;
                                                        break;
                                                    case '2':
                                                        $chaHabilidade = HINT_CHA_2;
                                                        break;
                                                    case '3':
                                                        $chaHabilidade = HINT_CHA_3;
                                                        break;
                                                    case '4':
                                                        $chaHabilidade = HINT_CHA_4;
                                                        break;
                                                }
                                                switch($cha["atitude"]) {
                                                    case '0':
                                                        $chaAtitude = HINT_CHA_0;
                                                        break;
                                                    case '1':
                                                        $chaAtitude = HINT_CHA_1;
                                                        break;
                                                    case '2':
                                                        $chaAtitude = HINT_CHA_2;
                                                        break;
                                                    case '3':
                                                        $chaAtitude = HINT_CHA_3;
                                                        break;
                                                    case '4':
                                                        $chaAtitude = HINT_CHA_4;
                                                        break;
                                                }
                                            }
                                            echo "	<dd>Conhecimento: ".$chaConhecimento."</dd><br>
                                                    <dd>Habilidade: ".$chaHabilidade."</dd><br>
                                                    <dd>Atitude: ".$chaAtitude."</dd><br>
											</dl>
										</div>
									</div>
							";
							}
						}

					?>
				</div>
	            <div class="button">
		            <form action="edit.php">
		                <input type="submit" value="Editar"></br></br>
		            </form>
	        	</div>
        	</div>
    </div>
</div>

</body>

</html>
