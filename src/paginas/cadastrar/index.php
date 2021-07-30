<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="public/css/global.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro</title>
</head>

<body>
    <div class="container">
        <h1>Cadastro</h1>
        <form action="?class=user&action=cadastro" method="post">
            <div class="form-control">
                <label for="user_nome">Nome do usuário</label>
                <input placeholder="Nome de usuário" type="text" name="user_nome" id="user_nome" required>
            </div>
            <div class="form-control">
                <label for="nome">Nome </label>
                <input placeholder="Nome" type="text" name="nome" id="nome" required>
            </div>
            <div class="form-control">
                <label for="email">E-mail</label>
                <input placeholder="Email" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="senha">Senha</label>
                <input placeholder="Senha" type="password" name="senha" id="senha" required>
            </div>
            <button type="submit">Cadastrar!</button>
            <div class="vocative">
                <span>Já é cadastrado?</span>
                <a href="?view=log-in">Realize o login!</a>
            </div>
        </form>
    </div>
</body>

</html>
