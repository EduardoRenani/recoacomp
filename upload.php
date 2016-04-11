<?php
    include("config/base.php");
    $extensao = strrchr($_FILES['arquivo']['name'], '.');
    $nome = $_SESSION['user_name'].$extensao;
    echo $nome;
    $foto = new Foto;
    if(isset($_POST['id_foto'])) $foto->setId((int) $_POST['id_foto']);
    $foto->setIdUsuario((int) $_SESSION['user_id']);
    $foto->setArquivo($_FILES['arquivo']);
    $foto->setNome($nome);
    $foto->setCaminho($_SERVER['DOCUMENT_ROOT']."/recoacomp/img/profile_images/".$nome);
    $foto->setDescricao("Foto de perfil");
    $foto->setTipo(1);
    $foto->setDataCadastro(date("Y-m-d"));
    $foto->salvaDados();
    echo "Upload feito com sucesso!";
    header('Location: edit.php');
?>