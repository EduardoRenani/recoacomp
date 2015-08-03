<?php
/**
 * Author: Cristina Otto
 * Date: Julho 2015
 */
?>
<html>
	<?php 
	require_once("config/config.cfg");
	include('views/_header.php'); ?>
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
		</script>
	</head>
	<body>
		<?php

		function percentual($x, $y){
			$num_calc = ( $x * 100 ) / $y;
			$num_format = number_format($num_calc, 2, ',', '.');
			return $num_format;
		}


		$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

		$sql_total_avaliacos_qualitativas = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali");
		$sql_total_avaliacos_qualitativas->execute();
		$total = $sql_total_avaliacos_qualitativas->fetchColumn(); 

		$sql_total_avaliacos_sobre_qualidade = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali
																			WHERE avaliacao != 4");
		$sql_total_avaliacos_sobre_qualidade->execute();
		$total_qualidade = $sql_total_avaliacos_sobre_qualidade->fetchColumn(); 

		//opção 1
		$sql_1 = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali 
											WHERE avaliacao = 1");
		$sql_1->execute();
		$num_sql_1 = $sql_1->fetchColumn(); 

		//opção 2
		$sql_2 = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali 
											WHERE avaliacao = 2");
		$sql_2->execute();
		$num_sql_2 = $sql_2->fetchColumn(); 

		//opção 3
		$sql_3 = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali 
											WHERE avaliacao = 3");
		$sql_3->execute();
		$num_sql_3 = $sql_3->fetchColumn(); 

		//opção 4
		$sql_4 = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali 
											WHERE avaliacao = 4");
		$sql_4->execute();
		$num_sql_4 = $sql_4->fetchColumn(); 

		//opção 5
		$sql_5 = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali 
											WHERE avaliacao = 5");
		$sql_5->execute();
		$num_sql_5 = $sql_5->fetchColumn(); 

		?>


		<div id="bloco_geral" style="width:100%; float:left;">
			<div id="div_fp" style="width:50%; float:left;padding:15px;">
				<h3>Porcentagem de falsos positivos</h3>

				<?php
				$sql = $db_connection->prepare("SELECT COUNT(*) FROM avaliacoes_quali 
		    										WHERE avaliacao != '1' AND avaliacao != '4'");
		    	$sql->execute();
		    	$num_falsos_positivos = $sql->fetchColumn(); 

		    	$fp = percentual($num_falsos_positivos, $total);

		    	?>

		    	<p style="font-size:40;text-align:center;"><?php echo $fp."%";?></p>
		    	<p>Pois de <?php echo $total." avaliações, ".$num_falsos_positivos;?> recomendações de objetos de aprendizagem foram avaliados como inadequados pelos alunos.</p>

			</div>
			<div id="div_fp" style="width:50%; float:left;padding:15px;">
				<h3>Avaliações em geral</h3>
				<?php
				$op_1 = percentual($num_sql_1, $total);
				$op_2 = percentual($num_sql_2, $total);
				$op_3 = percentual($num_sql_3, $total);
				$op_4 = percentual($num_sql_4, $total);
				$op_5 = percentual($num_sql_5, $total);
				?>

		    	<p>De todos os objetos avaliados, temos:</p>
		    	<p><?php echo $op_4;?>% - Não gosto de materiais nesse formato..</p>
				<p><?php echo $op_1;?>% - Achei super útil, complementa o conteúdo abordado em aula. </p>
				<p><?php echo $op_2;?>% - Super fácil, nenhuma novidade para mim.</p>
				<p><?php echo $op_3;?>% - Não entendi porque esse objeto foi recomendado nessa disciplina.</p>
				<p><?php echo $op_5;?>% - Achei complexo demais, abordava temas que nunca ouvi falar.</p>
			</div>
			<div id="div_fp" style="width:50%; float:left;padding:15px;">
				<h3>Avaliações sobre a qualidade da recomendação</h3>
				<?php
				$op_1_q = percentual($num_sql_1, $total_qualidade);
				$op_2_q = percentual($num_sql_2, $total_qualidade);
				$op_3_q = percentual($num_sql_3, $total_qualidade);
				$op_5_q = percentual($num_sql_5, $total_qualidade);
				?>

		    	<p>De todos os objetos avaliados quanto a QUALIDADE da recomendação, excluindo o gosto pessoal, temos:</p>
				<p><?php echo $op_1_q;?>% - Achei super útil, complementa o conteúdo abordado em aula. </p>
				<p><?php echo $op_2_q;?>% - Super fácil, nenhuma novidade para mim.</p>
				<p><?php echo $op_3_q;?>% - Não entendi porque esse objeto foi recomendado nessa disciplina.</p>
				<p><?php echo $op_5_q;?>% - Achei complexo demais, abordava temas que nunca ouvi falar.</p>

			</div>
			<div id="div_fp" style="width:50%; float:left;padding:15px;">
				<h3>Ranking de OA's</h3>
				<p>Os 10 OA's mais bem avaliados:</p>
				<?php
				//ranking de oas
				$sql_ranking = $db_connection->prepare("SELECT oa_id, AVG(avaliacao) AS MediaAvaliacao FROM avaliacoes_quali GROUP BY oa_id ORDER BY MediaAvaliacao DESC LIMIT 10");
				$sql_ranking->execute();
				$ranking = $sql_ranking->fetchAll(PDO::FETCH_OBJ); 
				$aux = 1;

				foreach($ranking as $r){
					$sql_oa = $db_connection->prepare("SELECT nome FROM cesta WHERE idcesta = '".$r->oa_id."'");
					$sql_oa->execute();
					$oa = $sql_oa->fetchColumn(); 

					echo "<p>".$aux."º - ".$oa." - Avalição: ".$r->MediaAvaliacao."</p>";
					$aux++;
				}
				?>

			</div>

		</div>
	</body>
</html>
