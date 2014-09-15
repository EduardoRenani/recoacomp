<?php
/**
 * Created by PhpStorm.
 * User: claus_000
 * Date: 15/09/14
 * Time: 09/29
 */

include('_header.php'); ?>

    <!-- clean separation of HTML and PHP -->
    <h2><?php echo $_SESSION['user_name']; ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<?php
require_once("../Classes/OA.php");

// Receber dados do formulário
//TODO Delton, criei uma tabela 1:1 "competencia_OA" no "recomendador-test". Apaga isso se visualizou.
if( $_SERVER["REQUEST_METHOD"] == "POST"){

    $nome = $_POST['nome'];
    $listaOA = $_POST['listaOA'];

    if(!$_SESSION['user_id']) //TODO SUBSTITUIR user_id pela session correta
        session_start();
    try{
        $usuarioProfessorID = $_SESSION['user_id']; //TODO user_id pela session correta
        $isProf = false;

        if($_SESSION['user_access'] >= 2) //TODO user_access pela session correta
            $isProf=true;
    }catch(Exception $e){
        echo "Exceção pega: ".  $e->getMessage(). "\n";
    }


    //Se não professor, é retirado da página.
    if(!$isProf){
        echo MESSAGE_YOU_SHOULDNT_BE_HERE."!";
        header('../Paginas/index.php');
        exit;
    }
    //PEGA ID COMPETENCIA
    $comp = new Competencia();
    $comp->criaCompetencia($nome);
    $id_competencia = $comp->getID();

    //Transforma lista de OAs em array de nomes
    $listaOA = explode(';',$listaOA);

    //Armazena lista de IDs das OAs no array $id_oa se a OA existe (já está testando)
    $contador = count($listaOA);
    for($i=0;$i < $contador;$i++){
        $id = getID_byName( $listaOA[$i]);
        if($id>0)
            array_push($id_oa,$id );
    }
    unset($listaOA);
    $contador = count($id_oa);
    if($contador >0){
        $db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

        for($i=0;$i < $contador;$i++){
            //Verifica se a relação já foi cadastrada
            $stmt = $db_connection->prepare("SELECT FROM competencia_OA(ID)  WHERE id_OA = :id_oa AND id_competencia = :id_competencia");
            $stmt->bindParam(':id_oa',$id_competencia, PDO::PARAM_INT);
            $stmt->bindParam(':id_competencia',$id_oa[$i], PDO::PARAM_INT);
            $stmt->execute();
            $stmt = $stmt->fetchAll();
            if(count($stmt) > 0)
                $jaExiste=true;
            else
                $jaExiste=false;
            //Se a relação não foi cadastrada, é cadastrada.
            if(!$jaExiste){

                $stmt = $db_connection->prepare("INSERT INTO competencia_OA(id_competencia, id_OA)  VALUES(:idcomp :idOA)");
                $stmt->bindParam(':idcomp',$id_competencia, PDO::PARAM_INT);
                $stmt->bindParam(':idOA',$id_oa[$i], PDO::PARAM_INT);
                $stmt->execute();

            }
        }
    }else{
        //TODO NENHUMA OA VÁLIDA FOI ESPECIFICADA. COMO VAMOS TRATAR ISSO? 
    }

}else{

}
?>

    <!-- formulario para cadastro de disciplinas -->
    <!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
    <form method="post" action="" name="registrar_nova_OA">
        <!--$this->criaDisc($_POST['nomeCurso'],$_POST['nomeDisciplina'],$_POST['descricao'], $_POST['user_id'], $_POST['senha']);-->
        <label for="nome"><?php echo WORDING_NAME_COMPETENCIA; ?></label>
        <input id="nome" type="text" name="nome" pattern="[a-zA-Z0-9]{2,64}" required />

        <label for="listaOA"><?php echo WORDING_OA_LIST; ?></label>
        <input id="listaOA" type="text" name="listaOA" pattern="[a-zA-Z0-9]{2,64}" required />

        <input type="submit" name="registrar_nova_Competencia" value="<?php echo WORDING_CREATE_DISCIPLINA; ?>" />
        <input type="reset" name="limpar" value="<?php echo WORDING_CLEAR_CREATE_DISCIPLINA; ?>" />

    </form><hr/>



    <!-- backlink -->
    <a href="index.php"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

<?php include('_footer.php');

?>