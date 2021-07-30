<?php

require_once "src/banco_de_dados/conexao_banco.php";

class user
{
    private Int $id;
    private String $email;
    private String $nome;
    private String $user_nome;
    private String $senha;

    function __construct(String $email, String $user_nome, String $nome, String $senha)
    {
        $this->email = $email;
        $this->user_nome = $user_nome;
        $this->nome = $nome;
        $this->senha = $senha;
    }

    public function salvar()
    {
        try {
            $this->hashSenha();
            $email =  $this->getEmail();
            $senha = $this->getSenha();
            $user_nome = $this->getuser_nome();
            $nome = $this->getnome();
            $stmt = conexao_banco::getConnection()->prepare('INSERT INTO user_dados (user_nome, email, nome, senha) VALUES (:user_nome, :email, :nome, :senha)');
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            $stmt->bindParam(":user_nome", $user_nome);
            $stmt->bindParam(":nome", $nome);
            $stmt->execute();
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private function hashSenha()
    {
        $this->setSenha(password_hash($this->getSenha(), PASSWORD_DEFAULT));
    }

    public static function listaruser()
    {
        try {
            $query = conexao_banco::getConnection()->query('SELECT * FROM user_dados');
            $list = $query->fetchAll(PDO::FETCH_ASSOC);
            $users = user::mapearuser($list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    private static function mapearuser($list){
        return array_map(function ($e) {
            $user =  new user($e['email'], $e['user_nome'], $e['nome'], $e['senha']);
            $user->setId($e['id']);
            return $user;
        }, $list);
    }
    public static function buscar(String $stringDeBusca)
    {
        try {
            $stmt = conexao_banco::getConnection()->prepare('SELECT * FROM user_dados WHERE email like :string_de_busca or user_nome like :string_de_busca or nome like :string_de_busca ');
            $stringDeBusca = '%' . $stringDeBusca . '%';
            $stmt->bindParam(":string_de_busca", $stringDeBusca);
            $list = $stmt->execute();
            $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $users = user::mapearuser($list);
            return $users;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    public static function logIn(String $email, String $senha)
    {
        try {
            $stmt = conexao_banco::getConnection()->prepare('SELECT * FROM user_dados WHERE email = :email');
            $stmt->bindParam(":email", $email);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $user = sizeof($result) > 0 ? $result[0] : NULL;
            if (is_null($user)) {
                throw new Exception("User not found");
            }
            if (!password_verify($senha, $user['senha'])) {
                throw new Exception("Invalid password");
            }
            $return = new user($user['email'], $user['user_nome'], $user['nome'], $user['senha']);
            $return->setId($user['id']);
            return $return;
        } catch (Exception $e) {
            echo `<div class="error-message">` . $e->getMessage() . `</div>`;
            return false;
        }
    }

    /**
     * Get the value of nome
     *
     * @return  String
     */
    public function getnome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @param  String  $nome
     *
     * @return  self
     */
    public function setnome(String $nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of id
     *
     * @return  Int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param  Int  $id
     *
     * @return  self
     */
    public function setId(Int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of user_nome
     *
     * @return  String
     */
    public function getuser_nome()
    {
        return $this->user_nome;
    }

    /**
     * Set the value of user_nome
     *
     * @param  String  $user_nome
     *
     * @return  self
     */
    public function setuser_nome(String $user_nome)
    {
        $this->user_nome = $user_nome;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  String
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  String  $email
     *
     * @return  self
     */
    public function setEmail(String $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of senha
     *
     * @return  String
     */
    public function getSenha()
    {
        return $this->senha;
    }

    /**
     * Set the value of senha
     *
     * @return  String
     */
    public function setSenha(String $senha)
    {
        $this->senha = $senha;

        return $this;
    }
}
