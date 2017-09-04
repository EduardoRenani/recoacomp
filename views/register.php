<!-- show registration form, but only if we didn't submit already -->
<?php if (!$registration->registration_successful && !$registration->verification_successful) { ?>
    <script>alert("Conta já ativa!"); parent.window.location = "index.php";</script>
<?php } ?>

<a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php'); ?>
