<meta charset="UTF-8">
<?php
/**
 * Author: Cristina Otto
 * Date: Julho 2015
 */
//RECEBENDO AVALIACOES
require_once('base.php');
$av_quanti = $_POST['rating'];
$av_quali = $_POST['av_quali'];
$av_subj = $_POST['av_subj'];
$id_oa = $_POST['id'];
$data = date("Y-m-d");
$db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
if(!empty($av_quanti) && !empty($av_quali)){
    //VERIFICA SE AS AVALIACOES SÃO MESMO REFERENTES A QUALIDADE DO OA
    if($av_quali == 1 || $av_quali == 3){
        $sql = $db_connection->prepare("INSERT INTO avaliacoes_quanti 
                                                (usuario_id, competencia_id, oa_id, data, avaliacao) 
                                                VALUES ('1', '1', '".$id_oa."', '".$data."', '".$av_quanti."')");
        $sql->execute();
    }else if($av_quali == 2 || $av_quali == 5){ //VERIFICA SE PODE SER ERRO DE CADASTRO, POIS O OA É MUITO AVANCADO OU INICIANTE PARA O PERFIL RECOMENDADO
        $sql = $db_connection->prepare("INSERT INTO avaliacoes_quanti 
                                                (usuario_id, competencia_id, oa_id, data, avaliacao) 
                                                VALUES ('INSERIR AQUI ID DO USUARIO', 'INSERIR AQUI ID DA COMPETENCIA', '".$id_oa."', '".$data."', '".$av_quanti."')");
        $sql->execute();
        /*
        SUGESTAO:
        ENVIAR EMAIL AO PROFESSOR AVISANDO QUE ESSE OA PODE ESTAR CADASTRADO COM CHA ERRADO.
        */
    }
        $sql2 = $db_connection->prepare("INSERT INTO avaliacoes_quali 
                                                (usuario_id, competencia_id, oa_id, data, avaliacao, comentario) 
                                                VALUES ('1', '1', '".$id_oa."', '".$data."', '".$av_quali."', '".$av_subj."')");
        $sql2->execute();
        echo "<script>alert(\"Avaliação enviada com sucesso! Obrigado!\");</script><script>window.history.back();</script>";
} else {
    echo "<script>alert(\"Erro no BD!\");</script><script>window.history.back();</script>";
}
?>