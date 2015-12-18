<?php include_once('_header.php'); ?>

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
function getDisciplinaId(id){
    var disciplinaId = id;
    document.getElementById('idDisciplina').value = id;
    //alert(id);
}
</script>

</head>
<?php 
$usuario = new User($_SESSION['user_id']); // Pega as informações do usuário
//$usuario->updateTipoVisao(2);
//print_r($usuario);
?>
<div class="fixedBackgroundGradient"></div>
<!-- ============== SIDEBAR =============== -->

<!-- ============== DISCIPLINAS DIPONIVEIS ============== -->
<?php include_once("view_disciplinas.php"); ?>
