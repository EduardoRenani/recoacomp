<?php
/**
 * Created by PhpStorm.
 * User: Delton
 * Date: 06/11/15
 * Time: 13:53
 */

class User {
    private $id;
    private $name;
    private $email;
    private $acesso;
    private $tipo_visao;


    // Constructor
    public function __construct($id = null) {
        $this->id = $id;
        if(!is_null($this->id)) {
            $this->load_user_data();
        }
    }

    // Retorna um objeto com os dados do usuário
    protected function load_user_data() {
        $database = new Database();
        $sql = "SELECT * FROM users WHERE user_id = :idUsuario";
        $database->query($sql);
        $database->bind(":idUsuario", $this->id);
        $this->setName($database->resultSet()[0]['user_name']);
        $this->setEmail($database->resultSet()[0]['user_email']);
        $this->setAcesso($database->resultSet()[0]['acesso']);
        $this->setTipoVisao($database->resultSet()[0]['tipo_visao']);
        return $database->resultSet();
    }


    /**
     * @param mixed $acesso
     */
    public function setAcesso($acesso)
    {
        $this->acesso = $acesso;
    }

    /**
     * @return mixed
     */
    public function getAcesso()
    {
        return $this->acesso;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $tipo_visao
     */
    public function setTipoVisao($tipo_visao)
    {
        $this->tipo_visao = $tipo_visao;
    }

    /**
     * @return mixed
     */
    public function getTipoVisao()
    {
        return $this->tipo_visao;
    }

    public function updateTipoVisao($tipoVisao){
        $database = new Database();
        if ($tipoVisao == VISAO_ALUNO) { //Se alterar para ver como professor
            $sql = "UPDATE users SET tipo_visao = :tipoVisaoAluno WHERE user_id = :idUsuario";
            $database->query($sql);
            $database->bind(":tipoVisaoAluno", VISAO_ALUNO);
            $database->bind(":idUsuario", $this->id);
            $database->execute();
        } elseif($tipoVisao == VISAO_PROFESSOR) { //Se alterar para ver como professor
            $sql = "UPDATE users SET tipo_visao = :tipoVisaoProfessor WHERE user_id = :idUsuario";
            $database->query($sql);
            $database->bind(":tipoVisaoProfessor", VISAO_PROFESSOR);
            $database->bind(":idUsuario", $this->id);
            $database->execute();
        }


    }


}

?>