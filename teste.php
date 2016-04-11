<html>
	<head>
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	    <script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
	    <script src="js/bootstrap.min.js"></script>
	    <script src="js/growl.js"></script>
	    <script src="jquery.bootstrap.wizard.js"></script>
		<script>
		$(function() {
			$("#cadastro").click(function() {
				$("#selectloco").toggle();
			});
		});
		</script>
		<style>
			#selectloco {
				display: none;
			}
		</style>
	</head>
	<body>
		<div id="cadastro">
			Cadastrar...
		</div>
		<div id="selectloco">
			<div style="width: 80px; height: 30px; overflow: auto;">
				<div>Disciplina</div>
				<div>Curso</div>
			</select>
		</div>
	</body>
</html>