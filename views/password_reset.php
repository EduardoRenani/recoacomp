<head>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/contato.css" rel="stylesheet">
    <link rel='stylesheet' media='screen and (min-width: 0px) and (max-width: 425px)' href='css/contato-xs.css' />
    <link rel='stylesheet' media='screen and (min-width: 425px) and (max-width: 1100px)' href='css/contato-small.css' />
    <link rel='stylesheet' media='screen and (min-width: 1100px)' href='css/contato-large.css' />
</head>

<div class="fixedBackgroundGradient"></div>

<!-- ============== HEADER ============== -->
<?php include('_header.php'); ?>

<!-- ============== JANELINHA ============== -->
<div class="janelinha">
        <div class="top-disciplinas"><div style="width: 50%; float: left; text-align: left">Recuperar Senha</div><div  style="width: 50%; float: right; text-align: right; padding-top: 7px; padding-right: 10px;" ><a href="index.php"><span class="glyphicon glyphicon-chevron-left"></span></a></div></div>
            <div class="disciplinas-content">
                <?php if ($login->passwordResetLinkIsValid() == true) { ?>
                <form method="post" action="password_reset.php" name="new_password_form">
                    <input type='hidden' name='user_name' value='<?php echo $_GET['user_name']; ?>' />
                    <input type='hidden' name='user_password_reset_hash' value='<?php echo $_GET['verification_code']; ?>' />

                    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
                    <input id="user_password_new" type="password" name="user_password_new" pattern=".{6,}" required autocomplete="off" />

                    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
                    <input id="user_password_repeat" type="password" name="user_password_repeat" pattern=".{6,}" required autocomplete="off" />
                    <input type="submit" name="submit_new_password" value="<?php echo WORDING_SUBMIT_NEW_PASSWORD; ?>" />
                </form>
                <!-- no data from a password-reset-mail has been provided, so we simply show the request-a-password-reset form -->
                <?php } else { ?>
                <form method="post" action="password_reset.php" name="password_reset_form">
                    <label for="user_name"><?php echo WORDING_REQUEST_PASSWORD_RESET; ?></label>
                    <input id="user_name" type="text" name="user_name" required />
                    <input type="submit" name="request_password_reset" value="<?php echo WORDING_RESET_PASSWORD; ?>" />
                </form>
            </div>
        <?php } ?>
</div>


