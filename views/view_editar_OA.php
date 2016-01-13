<?php include_once('_header.php'); ?>

<!-- TODO TRADUZIR-->
<head>

    <!-- Home -->

    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/home-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/home-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/home-large.css' />
    <link href="css/editar_OA.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">


    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
    <!-- Fim Home -->
    <script type="text/javascript">

    var idOA;

    function getOAId(id){
        var idOA = id;
        document.getElementById('idOA').value = id;
        idOA = id;
    }

    function deletarDisciplina() {
        //console.log(idDisciplina);
        jQuery.ajax({
            type: "GET",
            url: "ajax/exclui_oa.php",
            data: { 
                idOA : idOA,
            },
            cache: false,
            // importantinho.
            error: function(e){
                alert(e);
            },
            success: function(response){
                location.reload();
        }
    });
        
    }

    $(function() {
        $( "#tabs" ).tabs();
    });

</script>

</head>
<div class="fixedBackgroundGradient"></div>

<?php if(!isset($_POST['editar_OA'])){    ?>

<!-- ============== SIDEBAR =============== -->
<?php require_once("views/sidebar.php"); ?>

<!-- ============== OBJETOS QUE CRIEI ============== -->

<div class="objetos">
    <div class="top-objetos">Meus Objetos de Aprendizagem</div>
        <div class="objetos-content">
            <ul class="objetos-list">
            <?php
                    // Exibir todos os objetos que foi cadastrado pelo usuário no sistema               
    				//print_r($oa->getListaOAbyUser($_SESSION['user_id']));
    				$objetos = $oa->getListaOAbyUser($_SESSION['user_id']);
    				foreach($objetos as $objetosSistema => $oa){
    					//echo $oa['nome'].'<br>';
    					echo "<li class='objetos-item'>".
    							"<div class='objetos-item-content'>".
    								"<div class='lista-objeto'>".
    									"<h3>".$oa['nome']."</h3>".
                                        "<p>".$oa['descricao'].
                                        "<br>".
                                        "<form method='post' action='#' name='editar_OA'>".
                                            "<input type='hidden' id='idOA' name='idOA' value=".$oa['idcesta']." />".
                                            "<input type='submit' class='botao-excluir' name='editar_OA' action='' value='Informações do Objeto' />".
                                        "</form>                               
                                        <a href='#openModalDeleteDisciplina' id=".$oa['idcesta']." class='botao-excluir' onClick='getOAId(this.id)'>Excluir</a>". // 
                                    "</div>".
                                "</div>".
                            "</li>";				
    				} // end for each
			?>
                    <!-- Modal -->
                    <div id="openModalDeleteDisciplina" class="modalDialog" id="excluirDisciplinaDialog">
                            <div>
                                <a href="#close" title="Close" class="close">X</a>
                                <div class="top-cadastro"><?php echo 'Excluir OA?'; ?></div>
                                    <a href="#close" class="botao-med" id="<?php echo $oa['idcesta']?>" onClick="deletarDisciplina();" title="Deletar">Excluir</a>
                                    <br><br>
                                    <a href="#close" class="botao-med" title="Cancelar">Cancelar</a>
                                <!--/div-->
                            </div>
                            <!-- /.top-cadastro -->
                    </div> <!-- div modal -->
            </ul>
         </div>  

</div>


<?php  
}else{ // aqui vem o código lindo da parte de edição de objetos TODO 
        $objeto = $oa->getDadosOA($_POST['idOA']);
    ?>
    <div class='cadastrobase'>
        <div class="top-cadastrobase">
            <div class="text-left"><?php echo (WORDING_GLOBAL_COURSE).': '.$objeto[0]['nome'];; ?></div>
            <div class="text-right" ><!-- <a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a>--></div>
        </div>
    </div>
    <div class="cadastrobase-content">
       AAAAAAAAAAA
       a
       a
       a
       a

       aa
       a

       <br>
    </div>




    
<?php } // end set if isset post ?>
<?php include('_footer.php'); ?>

