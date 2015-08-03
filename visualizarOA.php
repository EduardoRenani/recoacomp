<html>
	<?php include('views/_header.php'); ?>
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
		<div style="width: 100%; height: 20%;">

			<!--Se quiserem remover o módulo de avaliação qualitativa, basta enviar o form para outra página e excluir a div com ID "modulo_avaliacao_qualitativa" abaixo-->
			<form id="form_avaliacoes" action="modulo_avaliacao_quali.php" method="POST" onsubmit="return false;">
			<div class='rating'>
				<h5>Por favor, classifique:</h5>
				<input type='radio' id='classificacao5' name='rating' value='5' />
				<label for='classificacao5' title='Adorei'></label>
				<input type='radio' id='classificacao4' name='rating' value='4' />
				<label for='classificacao4' title='Gostei'></label>
				<input type='radio' id='classificacao3' name='rating' value='3' />
				<label for='classificacao3' title='Achei meio termo'></label>
				<input type='radio' id='classificacao2' name='rating' value='2' />
				<label for='classificacao2' title='Não gostei'></label>
				<input type='radio' id='classificacao1' name='rating' value='1' />
				<label for='classificacao1' title='Detestei'></label>
			</div>

			<!--MODULO DE AVALIACAO QUALITATIVA-->
			<div id="modulo_avaliacao_qualitativa" style="width:100%;float:left;">
				<h5>Dessas frases, marque a que melhor complementa sua classificação desse objeto:</h5>
				<p><input type="radio" name="av_quali" value="4">Não gostei do formato desse formato.</input></p>
				<p><input type="radio" name="av_quali" value="1">Achei super útil, complementa o conteúdo abordado em aula.</input></p>
				<p><input type="radio" name="av_quali" value="2">Super fácil, o conteúdo não trouxe nenhuma novidade para mim.</input></p>
				<p><input type="radio" name="av_quali" value="3">Não entendi porque esse objeto foi recomendado nessa disciplina.</input></p>
				<p><input type="radio" name="av_quali" value="5">Achei complexo demais, abordava temas que nunca ouvi falar.</input></p>

			</div>
			<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
			<button onclick="document.getElementById('form_avaliacoes').submit();" style="width:100%;float:left;">Enviar Avaliações</button>
		</div>
		<iframe name="Stack" style="width: 100%; height: 80%" frameborder="0" id="iframe" src="<?php echo $_GET['url']; ?>"></iframe>
	</body>
</html>