<?php include_once('_header.php'); ?>

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

</head>

<body>
    
    <div class="fixedBackgroundGradient"></div>
    <?php require_once("sidebar-profile.php"); ?>

        <!-- ============== DISCIPLINAS ============== -->

    <div class="disciplinas">
        <div class="top-disciplinas">Meu Perfil</div>
            <div class="disciplinas-content">  </br> 
                <p class="subtitle">Nome:</p><p class="content-perfil"> <?php echo $_SESSION['user_name']; ?></p></br>
                <p class="subtitle">E-mail:</p><p class="content-perfil"> <?php echo $_SESSION['user_email']; ?></p>
            </div>  
            <div class="button">
                <form action="edit.php">
                    <input type="submit" value="Editar"></br></br>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
