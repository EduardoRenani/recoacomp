<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

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

<!-- ============== HEADER ============== -->
    <header class="header-large">
        <a href="index.html" id="logo"></a> <!--muda quando o usuario estiver logged in e leva para o home.html"-->
            <nav>

                <a href="#" id="menu-icon"></a>

                <ul>

                <li><a href="index.html" class="current">Home</a></li> <!--muda quando o usuario estiver logged in e leva para o home.html"-->
                <li><a href="contato.html">Contato</a></li>
                <li><a href="equipe.html">Equipe</a></li>

                </ul>

            </nav>
    
    </header>


    <!-- ============== SIDEBAR ============== -->
        <div class="sidebar"> 

            <div class="top-sidebar">Bem Vindo, <?php echo $_SESSION['user_name']; ?></div>
                <div class="sidebar-content">           
                        <ul class="sidebar-menu">
                            <li>
                                <a href="index.php">Home</a>
                            </li>
                             <li>
                                <a href="profile_show.php" id="active">Meu Perfil</a>
                            </li>
                        </ul>
                </div>  
        </div>

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
    <!-- Footer
    <footer>
        <div class="container-footer">
            <div class="row" style="width:100%"> width 100% porque o bootstrap tenta estragar tudo
                <div class="span1">
                    <a href="http://www.nuted.ufrgs.br/"><img src="img/nutedYellow.png" class="footer-logo"></a> 
                    <a href="http://www.ufrgs.br/sead"><img src="img/ufrgs_sead.png" class="footer-logo"></a>
                </div>
                <div class="span2">
                     <ul class="list-inline">
                        <li>
                           <a href="#home">Home</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                         <li>
                           <a href="#sobre">Sobre</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                         <li>
                           <a href="#contato">Contato</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                         <li>
                           <a href="#equipe">Equipe</a>
                        </li>
                        <li class="footer-menu-divider">.</li>
                     </ul>
               </div>
            </div>
        </div>
    </footer> -->

</body>

</html>
