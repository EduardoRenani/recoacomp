<?php
/*
 * Created by Delton & Clauser
 * Date: 28/08/14
 * Time: 14:40
 * Classe Registrar
 * Controla o registro dos usuarios
 */

class Registrar{
    /**
     * @var objeto $conexao_db Conexao com o banco de dados
     */
    private $db_conexao = null;
    /**
     * @var bool registro_sucedido estado do registro
     */
    public $registro_sucedido;
    /**
     * @var bool verificacao_sucedida estado da verificacao
     */
    public $verificacao_sucedida;
    /**
     * @var array $erros Coleta de mensagens de erro
     */
    public $erros = array();
    /**
     * @var array $mensagens Coleta de mensagens do sistema
     */
    public $mensagens = array();

    /**
     * Funcção "_construct()" automaticamente starta quando uma classe desse objeto é criada.
     * ex: $login = new Login();
     */

    /**
     * Checagem da conexao com o banco de dados
     * Retorna true caso conexao já está aberta, falso caso contrario
     */
    private function conexaoBancoDeDados(){
        if ($this->db_conexao != null){
            return true;
        } else {
            try {
                $this->db_conexao = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
                return true;
            } catch (PDOException $e) {
                $this->erros[] = MESSAGE_DATABASE_ERROR;
                return false;
            }
        }
    }
    /**
     * Controla o processo de registro e verifica os erros possiveis
     * e cria o usuario no banco de dados se tudo estiver correto
     * @param string nome_usuario Contem o nome do usuario a ser registrado
     * @param string senha_usuario Contem a senha do novo usuario
     * @param string senha_usuario_rep Contem a senha repetida (para verificação)
     * @param string captcha Contem o captcha para possiveis ataques ao sistema
     * OBS: Mensagens em português para futuras traduções
     * OBS[2]: Está sendo usado o método PDO invés de MYSQLI para conexão ao BD
     */
    private function registrarNovoUsuario($nome_usuario, $email_usuario, $senha_usuario, $senha_usuario_rep, $captcha){
        // Remoção de espaços desnecessários
        $nome_usuario = trim($nome_usuario);
        $email_usuario = trim($email_usuario);
        $acesso = 1; // Tipo de acesso para usuario comum [TO'DO NOVO USUARIO É COMUM]

        if (strtolower($captcha) != strtolower($_SESSION['captcha'])) { // Validações gerais
            $this->erros[] = MESSAGE_CAPTCHA_WRONG;
        } elseif (empty($nome_usuario)) {
            $this->erros[] = MESSAGE_USERNAME_EMPTY;
        } elseif (empty($senha_usuario) || empty($senha_usuario_rep)) {
            $this->erros[] = MESSAGE_PASSWORD_EMPTY;
        } elseif ($senha_usuario !== $senha_usuario_rep) {
            $this->erros[] = MESSAGE_PASSWORD_BAD_CONFIRM;
        } elseif (strlen($senha_usuario) < 6) {
            $this->erros[] = MESSAGE_PASSWORD_TOO_SHORT;
        } elseif (strlen($nome_usuario) > 64 || strlen($nome_usuario) < 2) {
            $this->erros[] = MESSAGE_USERNAME_BAD_LENGTH;
        } elseif (!preg_match('/^[a-z\d]{2,64}$/i', $nome_usuario)) { //  PaRa 3v1tar OrkUt1sses.
            $this->erros[] = MESSAGE_USERNAME_INVALID;
        } elseif (empty($email_usuario)) {
            $this->erros[] = MESSAGE_EMAIL_EMPTY;
        } elseif (strlen($email_usuario) > 64) {
            $this->erros[] = MESSAGE_EMAIL_TOO_LONG;
        } elseif (!filter_var($email_usuario, FILTER_VALIDATE_EMAIL)) {
            $this->erros[] = MESSAGE_EMAIL_INVALID;
        } else if ($this->conexaoBancoDeDados()) { // Verificar se usuario ja está cadastrado
            $query_check_nome_usuario = $this->db_conexao->prepare('SELECT nome, email FROM usuarios WHERE nome=:nome_usuario OR email=:email_usuario');
            //Bindar variáveis para questões de segurança
            $query_check_nome_usuario->bindValue(':nome_usuario', $nome_usuario, PDO::PARAM_STR);
            $query_check_nome_usuario->bindValue(':email_usuario', $email_usuario, PDO::PARAM_STR);
            $query_check_nome_usuario->execute();
            $result = $query_check_nome_usuario->fetchAll();

            //Verifica se o usuario está no banco de dados
            if (count($result) > 0) {
                for ($i = 0; $i < count($result); $i++){
                    $this->erros[] = ($result[$i]['nome'] == $nome_usuario) ? MESSAGE_USERNAME_EXISTS : MESSAGE_EMAIL_ALREADY_EXISTS;
                }
            } else {
                // Processo de encriptação via HASH
                // Verifica em qual expoente está a quantidade de valores possiveis no config.cfg
                $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
                $user_password_hash = password_hash($senha_usuario, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
                //Gerador de hash randômico para verificação de email
                $user_activation_hash = sha1(uniqid(mt_rand(), true));

                // Insere novos usuarios no banco de dados [FINALMENTE NÉ?]
                $query_new_user_insert = $this->db_conexao->prepare('INSERT INTO usuarios (nome, senha, email, hash_ativacao, ip_registro, data_registro, acesso) VALUES(:nome_usuario, :senha_usuario, :email_usuairo, :user_activation_hash, :user_registration_ip, now(), :acesso)');
                $query_new_user_insert->bindValue(':nome', $nome_usuario, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':senha', $user_password_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':email', $email_usuario, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':hash_ativacao', $user_activation_hash, PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':user_registration_ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR);
                $query_new_user_insert->bindValue(':acesso', $acesso, PDO::PARAM_STR);
                $query_new_user_insert->execute();

                // ID do novo usuario
                $user_id = $this->db_conexao->lastInsertId();

                // Email de verificação
                if ($query_new_user_insert) {
                    if($this->sendVerificationEmail($user_id, $email_usuario,$user_activation_hash)) {
                        $this->mensagens[] = MESSAGE_VERIFICATION_MAIL_SENT;
                        $this->registro_sucedido = true;
                    } else {
                        //Deleta a conta do usuario se o email nao for enviado
                        $query_delete_user = $this->db_conexao->prepare('DELETE FROM usuarios WHERE idusuario=:user_id');
                        $query_delete_user->bindValue(':idusuario', $user_id, PDO::PARAM_INT);
                        $query_delete_user->execute();

                        $this->erros[] = MESSAGE_VERIFICATION_MAIL_ERROR;
                    }
                } else {
                    $this->erros[] = MESSAGE_REGISTRATION_FAILED;
                }
            }
        }
    }


}

?>