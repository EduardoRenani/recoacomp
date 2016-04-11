<form enctype="multipart/form-data" action="upload.php" method="POST">
<input type="file" name="arquivo">
<input type="submit">
</form>
<?php
include("config/base.php");
var_dump($_SESSION);
?>