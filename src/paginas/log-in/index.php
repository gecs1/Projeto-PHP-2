<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
<link rel="stylesheet" href="public/css/global.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h1>Login</h1>
        <form action="?class=user&action=login" method="post">
            <div class="form-control">
                <label for="email">E-mail</label>
                <input placeholder="Email" type="email" name="email" id="email" required>
            </div>
            <div class="form-control">
                <label for="senha">Senha</label>
                <input placeholder="Senha" type="password" name="senha" id="senha" required>
            </div>
            <button type="submit">Entrar!</button>
            <div class="vocative">
                <span>Novo por aqui?</span>
                <a href="?view=cadastrar">Cadastre-se</a>
            </div>
        </form>
    </div>
</body>

</html>