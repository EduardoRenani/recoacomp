<!doctype html>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jplot/jquery.jqplot.js"></script>
<script type="text/javascript" src="js/jplot/plugins/jqplot.barRenderer.js"></script>
<script type="text/javascript" src="js/jplot/plugins/jqplot.categoryAxisRenderer.js"></script>
<script type="text/javascript" src="js/jplot/plugins/jqplot.pointLabels.js"></script>
<link rel="stylesheet" type="text/css" href="js/jplot/jquery.jqplot.css" />
<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="js/jplot/excanvas.js"></script><![endif]-->
<?php

require_once("config/base.php");

$disciplina = new Disciplina;
$disciplina->setIdDisciplina(intval($_GET['idDisciplina']));
$indices = $disciplina->getIndices();
//echo "<pre>";
//var_dump($indices);
//var_dump($disciplina->listaObjetosDisciplina($_GET['idDisciplina']));
//var_dump($indices);
include("views/view_painel_disciplina.php");
?>