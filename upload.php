<?php
function getExtension($str) {$i=strrpos($str,".");if(!$i){return"";}$l=strlen($str)-$i;$ext=substr($str,$i+1,$l);return $ext;}
$formats = array("jpg");///"png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	//echo $_SESSION['user_name'];
 $name = $_FILES['file']['name'];
 $size = $_FILES['file']['size'];
 $tmp  = $_FILES['file']['tmp_name'];
 if(strlen($name)){
  $ext = getExtension($name);
  if(in_array($ext,$formats)){
   if($size<(5024*5024)){
    $imgn = $_POST['idUsuario'].".".$ext;
    if(move_uploaded_file($tmp, "./img/profile_images/".$imgn)){
     //echo "File Name : ".$_FILES['file']['name'];
     //echo "<br/>File Temporary Location : ".$_FILES['file']['tmp_name'];
     //echo "<br/>File Size : ".$_FILES['file']['size'];
     //echo "<br/>File Type : ".$_FILES['file']['type'];

     echo "<br/><img width='300px' style='margin-left:10px;' src='img/profile_images/".$imgn."'>";
    }else{
     echo "Erro no upload";
    }
   }else{
    echo "Tamanho máximo de imagem 5MB";
   }
  }else{
   echo "O formato da imagem deve ser jpg";
  }
 }else{
  echo "Por favor selecione uma imagem.";
  exit;
 }
}
?>