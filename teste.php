
<?php
/**
 * Created by PhpStorm.
 * User: Cláuser
 * Date: 14/10/14
 * Time: 15:59
 */

require_once('base.php');


/*

$lista = new Lista(array(2,3,5,1,4,3,-1,8,0,-15,-4,-3,-2,2,-3));

$matriz = $lista->ordenate(1,2);
//var_dump($matriz);
echo("<br />");
$cont = count($matriz[0]);
for($i=0;$i<$cont;$i++){

    echo $matriz[0][$i]." ".$matriz[1][$i]."<br />";

}

$matriz = $lista->ordenate(0,-4);
//var_dump($matriz);
echo("<br />");
$cont = count($matriz[0]);
for($i=0;$i<$cont;$i++){

    echo $matriz[0][$i]." ".$matriz[1][$i]."<br />";

}

$matriz = $lista->ordenate(3,4);
//var_dump($matriz);
echo("<br />");
$cont = count($matriz[0]);
for($i=0;$i<$cont;$i++){

    echo $matriz[0][$i]." ".$matriz[1][$i]."<br />";

}

*/

//Exemplo de recomendação.
//
//O primeiro argumento é o ID do usuário
////O segundo é o ID da disciplina
	//$b = new Recomendacao(6,69);
	//$b->recomenda();

//echo "<hr/>";
//$a = new Comp(7,6,69);
//$a->addOA(2);
//$a->addOA(6);
//$a->writeOAs();

//session_start();
//if ($_SESSION){
	$id = 50;
	echo "<br/><center><font size='6'>Teste de Recomendacao para a disciplina de ID: ".$id."</font></center><br/><br/>";
	echo "<hr/>";

	//$vet é o vetor de ids de competências que devem ser exibidas. Se null, significa todas.
	$vet = array(1,2);
	$vet = null;
	$c= new Recomendacao($id,$vet);

?>