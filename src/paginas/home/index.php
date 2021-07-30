<?php
require_once "src/modelo_user/user.php";
$user = $_SESSION["loggedUser"];
if (isset($_GET["pesquisa"])) {
    $users = user::buscar($_GET["pesquisa"]);
} else {
    $users = user::listaruser();
}
function logOut()
{
    session_destroy();
    header("Location: /");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="public/css/global.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Home</title>
</head>

<body>
    <div class="container">
        <section>
            <form action="?tela=home" method="GET">
                <label for="pesquisa">Pesquisar:</label>
                <input type="text" name="pesquisa" value="<?php echo isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : "" ?>">
                <button type="submit">Enviar</button>
            </form>
            <h1> Welcome <?= $user['user_nome'] ?></h1>
            <table>
                <thead>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Nome de Usuário</th>
                    <th>Nome</th>
                </thead>
                <?php foreach ($users as $key => $value) : ?>
                    <tr>
                        <td><?= $value->getId() ?></td>
                        <td><?= $value->getEmail() ?></td>
                        <td><?= $value->getuser_nome() ?></td>
                        <td><?= $value->getnome() ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <form action="?class=user&action=logout" method="post" required>
                <button type="submit">Sair</button>
            </form>
        </section>
    </div>
</body>

</html>