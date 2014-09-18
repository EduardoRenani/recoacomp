<?php include('_header.php'); ?>

<?php
// if you need the user's information, just put them into the $_SESSION variable and output them here
echo WORDING_YOU_ARE_LOGGED_IN_AS . $_SESSION['user_name'] . "<br />";
//echo WORDING_PROFILE_PICTURE . '<br/><img src="' . $login->user_gravatar_image_url . '" />;
?>

<div>
    <a href="index.php?logout"><?php echo WORDING_LOGOUT; ?></a>
    <a href="edit.php"><?php echo WORDING_EDIT_USER_DATA; ?></a>

</div>

<?php 
if ($_SESSION['acesso'] == 1)
	include('_options_aluno.php'); 
	//echo WORDING_USER_STUDENT . "<br />";
else if ($_SESSION['acesso'] == 2)
	include('_options_professor.php'); 
	//echo WORDING_USER_PROFESSOR . "<br/>";
else if($_SESSION['acesso'] == 3)
	echo WORDING_USER_ADMIN . "<br/>";
?>


<?php include('_footer.php'); ?>
