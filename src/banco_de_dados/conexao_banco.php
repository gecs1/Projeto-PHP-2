<?php
class conexao_banco
{
    public static function getConnection()
    {
        $database = "projeto_2";
        $username = "root";
        $senha = "";
        return new PDO("mysql:host=localhost;dbname=$database", $username, $senha);
    }
}
