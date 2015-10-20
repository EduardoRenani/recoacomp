<?php include('_header.php'); ?>

<head>
    <link href="css/base_cadastro.css" rel="stylesheet">

    <link rel="stylesheet" href="css/cropper.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/cropper.css">


    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrapCrop.min.js"></script>
    <script src="js/cropper.min.js"></script>

    <!--script src="js/jquery.js"></script--><!-- jQuery is required -->
    <!--script src="js/cropper.js"></script-->
    
    <script src="js/main.js"></script>
   
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

<div class="container" id="crop-avatar">

    <!-- Current avatar -->
    <div class="avatar-view" title="Change the avatar">
      <img src="picture.jpg" alt="Avatar">
    </div>

    <!-- Cropping modal -->
    <div class="modal fade" id="avatar-modal" aria-hidden="true" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1" >
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form class="avatar-form" action="crop.php" enctype="multipart/form-data" method="post">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="avatar-modal-label">Change Avatar</h4>
            </div>
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input type="hidden" class="avatar-src" name="avatar_src">
                  <input type="hidden" class="avatar-data" name="avatar_data">
                  <label for="avatarInput">Local upload</label>
                  <input type="file" class="avatar-input" id="avatarInput" name="avatar_file">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-md"></div>
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-md-9">

                  </div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-block avatar-save">Done</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
  </div>

<!-- Cropper -->

        <!--form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="<?php echo $_SESSION['user_name']; ?>" id="<?php echo $_SESSION['user_name']; ?>">
            <input type="submit" value="Upload Image" name="submit">
        </form-->

        <?php

            //echo '<img src="img/profile_images/'.$_SESSION['user_name'].'.png" alt=""/>'
        ?>
        

    </div>
</div>

<!-- backlink -->
<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
