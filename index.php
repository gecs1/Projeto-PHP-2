<?php
session_start();

if (isset($_GET["view"])) {
    require_once "src/paginas/" . $_GET["view"] . "/index.php";
} else if (isset($_GET["action"]) && isset($_GET["class"])) {
    $controlador = $_GET["class"]. "controlador";
    $action = $_GET["action"];
    require_once "src/controlador/" . $controlador . ".php";
    $controlador = new $controlador();
    $controlador->$action();
} else if (isset($_SESSION["loggedUser"])) {
    require_once "src/paginas/home/index.php";
} else {
    require_once "src/paginas/log-in/index.php";
}
