<?php include('_header.php'); ?>

<head>
    <link href="css/base_cadastro.css" rel="stylesheet">

    <!-- scripts -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <!--script type="text/javascript" src="js/jquery.form.min.js"></script-->
    <script src="http://malsup.github.com/jquery.form.js"></script> 
    



</head>

<!-- clean separation of HTML and PHP 
<h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>
<h2><?php echo $_SESSION['user_email']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>-->

<div class="fixedBackgroundGradient"></div>

<div class="cadastrobase" >
    <div class="top-cadastrobase"><div class="text-left"><?php echo (WORDING_EDIT_YOUR_CREDENTIALS); ?></div><div class="text-right" ><a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a></div></div>
    <div class="cadastrobase-content">

        <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
        <form method="post" action="edit.php" name="user_edit_form_name">
            <label for="user_name"><?php echo WORDING_NEW_USERNAME; ?></label>
            <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_name']; ?>)<br />
            <input type="submit" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
        </form><hr/>

        <!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
        <form method="post" action="edit.php" name="user_edit_form_email">
            <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
            <input id="user_email" type="email" name="user_email" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo $_SESSION['user_email']; ?>)<br />
            <input type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
        </form><hr/>

        <!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
        <form method="post" action="edit.php" name="user_edit_form_password">
            <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
            <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

            <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
            <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

            <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
            <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

            <input type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
        </form>

<!-- cropper -->
<!--div class="container">
  <img src="picture.jpg">
</div-->

    <form enctype="multipart/form-data" action="upload.php" method="POST">
        <?php 
        $foto = new Foto((int) $_SESSION['user_id']);
        if(!is_null($foto->getCaminho())) {
            echo "<img style='width: 250px; height: auto;' src='img/profile_images/".$foto->getNome()."'>";
            echo "<input type='hidden' name='id_foto' value='".$foto->getId()."'>";
        }
        else {
            echo "<img style='width: 250px; height: auto;' src='img/profile_images/head.png'>";
        }
        ?>
        <input type="file" name="arquivo">
        <br>A imagem deve ser no formato JPG com tamanho máximo de 5MB</br>
        <input type="submit"><br/><br/>
    </form>

        

    </div>
</div>

<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
