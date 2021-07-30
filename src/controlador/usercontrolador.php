<?php

require_once "src/modelo_user/user.php";

class usercontrolador
{
    public function cadastro()
    {
        $user_nome = $_POST["user_nome"];
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        if (!isset($user_nome) || !isset($nome) || !isset($email) || !isset($senha)) {
            require_once "src/paginas/cadastrar/index.php";
        } else {
            $user = new user($email, $user_nome, $nome, $senha);
            $result = $user->salvar();
            if (!is_bool($result)) {
                require_once "src/paginas/log-in/index.php";
            } else {
                require_once "src/paginas/cadastrar/index.php";
            }
        }
    }

    public function login()
    {
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        if (!isset($email) || !isset($senha)) {
            require_once "src/paginas/cadastrar/index.php";
        } else {
            $result = user::logIn($email, $senha);
            if (!is_bool($result)) {
                $_SESSION["loggedUser"] = array("id" => $result->getId(), "user_nome" => $result->getuser_nome(), "email" => $result->getEmail());
                require_once "src/paginas/home/index.php";
            } else {
                require_once "src/paginas/log-in/index.php";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: ?view=log-in");
    }
}