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

		<!-- Notificações -->
		<script type="text/javascript" src="js/jquery.noty.packaged.min.js"></script>
		<!-- Pega Tempo de acesso -->
		<script type="text/javascript" src="js/pegaTempo.js"></script>
		<!-- Fim Home -->
		</script>
		<script type="text/javascript">
			//Função que adiciona as avaliações no banco de dados
			//Faz validações também
			function submitAvaliacoes() {
				if (($( "input[type=radio][name=av_quali]" ).is(":checked")) && ($('input[type=radio][name=rating]').is(":checked"))){ // Verifica se os dados foram coletados
					document.getElementById('form_avaliacoes').submit();
				}else{
					//alert('Preencher os dados do formulário');
					var n = noty({
                        text: 'Por favor, classifique',
                        layout: 'topCenter',
                        theme: 'relax', // or 'relax'
                        type: 'warning',
                        killer: true, // MATA OS OUTROS NOTYS MWHAHAHA
                        animation: {
                            open: {height: 'toggle'}, // jQuery animate function property object
                            close: {height: 'toggle'}, // jQuery animate function property object
                            easing: 'swing', // easing
                            speed: 500 // opening & closing animation speed
                        },
                        //timeout: 500
                        // Desaparecer
                        
                    });
					
				}
				
			}
		</script>
	</head>
	<body onload="document_OnLoad(<?= $_GET['idOA']; ?>, <?= $_GET['idUsuario']; ?>, <?= $_GET['idDisciplina']; ?>)">
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
			<div id="modulo_avaliacao_qualitativa" style="width:50%;float:right;">
				<h5>Dessas frases, marque a que melhor complementa sua classificação desse objeto:</h5>
				<p><input type="radio" name="av_quali" value="4">Não gostei do formato desse formato.</input></p>
				<p><input type="radio" name="av_quali" value="1">Achei super útil, complementa o conteúdo abordado em aula.</input></p>
				<p><input type="radio" name="av_quali" value="2">Super fácil, o conteúdo não trouxe nenhuma novidade para mim.</input></p>
				<p><input type="radio" name="av_quali" value="3">Não entendi porque esse objeto foi recomendado nessa disciplina.</input></p>
				<p><input type="radio" name="av_quali" value="5">Achei complexo demais, abordava temas que nunca ouvi falar.</input></p>

			</div>
			<div style='padding-left: 10px; width: 48%; float: left;'><textarea name="av_subj" placeholder='Deixe um comentário'></textarea></div>
			<input type="hidden" name="id" value="<?php echo $_GET['idOA']; ?>" />
			<button onclick="submitAvaliacoes();" style="width:100%;float:left;">Enviar Avaliações</button>
			</form>
		</div>
		<iframe name="Stack" style="width: 100%; height: 80%" frameborder="0" id="iframe" src="<?php echo $_GET['url']; ?>"></iframe>
	</body>
</html>