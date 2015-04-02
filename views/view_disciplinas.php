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

</head>
<div class="fixedBackgroundGradient"></div>
<?php require_once("sidebar.php"); ?>

<!-- ============== DISCIPLINAS ============== -->

<div class="disciplinas">
<div class="top-disciplinas">Minhas Disciplinas</div>
        <div class="disciplinas-content">           
            <ul class="disciplinas-list">

            <?php

                //PASSO 1: PEGAR A LISTA DE DISCIPLINAS DO USUÁRIO

                $listaDisc = array();
                        /* Create a new mysqli object with database connection parameters */
                $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

                if(mysqli_connect_errno()) {
                    echo "Connection Failed: " . mysqli_connect_errno();
                    exit();
                }

                /* Create a prepared statement */
                if($stmt = $mysqli -> prepare("SELECT `disciplina_iddisciplina`FROM `usuario_disciplina` WHERE `usuario_idusuario`=?")) {

                    /* Bind parameters
                    s - string, b - blob, i - int, etc */
                    $stmt -> bind_param("i", $_SESSION['user_id']);

                    /* Execute it */
                    $stmt -> execute();

                    /* Bind results */
                    $stmt -> bind_result($result);

                    /* Fetch the value */
                    while ($stmt -> fetch() ){
                        array_push($listaDisc, $result);
                    }

                    /* Close statement */
                    $stmt -> close();
                }

                /* Close connection */
                //$mysqli -> close();   <-- Fazer depois.

                //PASSO 2: TRATAR CADA DISCIPLINA 1 A 1.
                $cont = count($listaDisc);
                
                for($i=0;$i<$cont;$i++){
                    
                    //PASSO 3: PEGAR O TITULO DA DISCIPLINA
                    if($stmt = $mysqli -> prepare("SELECT `nomeDisciplina`, `nomeCurso`, `usuarioProfessorID`, `descricao` FROM `disciplina` WHERE `iddisciplina`=?")) {

                        $disc=array();
                        //$result=array();

                        /* Bind parameters
                        s - string, b - blob, i - int, etc */
                        $stmt -> bind_param("i", $listaDisc[ $i ]);

                        /* Execute it */
                        $stmt -> execute();

                        /* Bind results */

                        $stmt -> bind_result($disc['nomeDisc'],$disc['nomeCurso'],$disc['professor_id'], $disc['descricao']);

                        /* Fetch the value */

                        while( $stmt -> fetch() ){
                            //array_push($disc,$result);
                            /*$disc['nomeDisc'] = $result['nomeDisc'];
                            $disc['nomeCurso'] = $result['nomeCurso'];
                            $disc['professor_id'] = $result['professor_id'];
                            $disc['descricao'] = $result['descricao'];*/
                        }



                        //unset($result);

                        /* Close statement */
                        $stmt -> close();

                    }

                    if($stmt = $mysqli -> prepare("SELECT `user_name`FROM `users` WHERE `user_id`=?")) {

                    /* Bind parameters
                    s - string, b - blob, i - int, etc */
                    $stmt -> bind_param("i", $disc['professor_id']);

                    /* Execute it */
                    $stmt -> execute();

                    /* Bind results */
                    $stmt -> bind_result($disc['professor_name']);

                    /* Fetch the value */
                    while ($stmt -> fetch() ){
                        //$professorName = $result;
                    }

                    /* Close statement */
                    $stmt -> close();
                    }

                    echo
                        "<li class='disciplinas-item'>".
                            "<div class='disciplina-item-content'>".
                                "<h3>".$disc['nomeDisc']."</h3>".
                                "<h4>".$disc['nomeCurso']." - ".$disc['professor_name']."</h4>".
                                "<p>".$disc['descricao']."</p>".
                            "</div>".
                            "<div class='button'><form action='recomendacao.php' method='POST'>"./*action é só para mostrar, no site em si não tem isso*/
                                "<input type='hidden' name='disc' value='".$listaDisc[ $i ]."'>".
                                "<input type='submit' value='Receber Recomendação'></br></br>".
                            "</form></div>".
                        "</li>";

                    unset($disc);
                }
                $mysqli -> close();
            ?>
                        <!--
                        <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Ergonomia Aplicada ao Design II</h3> <!--nomes de cadeiras servem só de exemplo do funcionamento--
                                <h4>Júlio Van der Linden - ARQ03140</h4>
                                <p>Conhecimento dos fundamentos da ergonomia Cognitiva, da Interação Homem Computador e da Experiência do Usuário.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"--
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                         <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Ciência e Tecnologia dos Materiais</h3>
                                <h4>Annelise Alves - ENG02033</h4>
                                <p>Correlação entre propriedades, estrutura, processos de fabricação e desempenho dos diferentes materiais utilizados em produtos
industriais.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"--
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>
                         <li class="disciplinas-item">
                            <div class="disciplina-item-content">
                                <h3>Design Contenporâneo: Teoria e História</h3>
                                <h4>Maria do Carmo Curtis - ARQ03114</h4>
                                <p>Correntes atuais e as diferentes práticas e resultados obtidos por profissionais do design no âmbito internacional. Os vários graus de
industrialização no mundo. Países na periferia da industrialização.</p>
                            </div>
                            <div class="button"><form action="#"><!--action é só para mostrar, no site em si não tem isso"--
                                <input type="submit" value="Receber Recomendação"></br></br>
                            </form></div>
                        </li>-->
            </ul>
         </div>  
</div>


</div>


<?php include('_footer.php'); ?>
