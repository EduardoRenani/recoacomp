<html>
	<?php include('_header.php'); ?>
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
			<div class='rating'>
				<h5>Por favor, classifique:</h5>
				<input type='radio' id='classificacao<?php echo $_GET['id']; ?>5' name='rating<?php echo $_GET['id']; ?>' value='5' />
				<label for='classificacao<?php echo $_GET['id']; ?>5' title='Rocks!'></label>
				<input type='radio' id='classificacao<?php echo $_GET['id']; ?>4' name='rating<?php echo $_GET['id'];; ?>' value='4' />
				<label for='classificacao<?php echo $_GET['id']; ?>4' title='Pretty good'></label>
				<input type='radio' id='classificacao<?php echo $_GET['id']; ?>3' name='rating<?php echo $_GET['id']; ?>' value='3' />
				<label for='classificacao<?php echo $_GET['id']; ?>' title='Meh'></label>
				<input type='radio' id='classificacao<?php echo $_GET['id']; ?>2' name='rating<?php echo $_GET['id']; ?>' value='2' />
				<label for='classificacao<?php echo $_GET['id']; ?>2' title='Kinda bad'></label>
				<input type='radio' id='classificacao<?php echo $_GET['id']; ?>1' name='rating<?php echo $_GET['id']; ?>' value='1' />
				<label for='classificacao<?php echo $_GET['id']; ?>1' title='Sucks big time'></label>
			</div>
		</div>
		<iframe name="Stack" style="width: 100%; height: 80%" frameborder="0" id="iframe" src="<?php echo $_GET['url']; ?>"></iframe>
	</body>
</html>