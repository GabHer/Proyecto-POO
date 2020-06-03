<?php
    header("Content-Type: application/json");
    include_once("../class/class-comentario.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $Comentario= new Comentario(
                $_POST['idUsuario'],
                $_POST['comment']
                
            );
            echo $Comentario-> guardarComentario($database->getDB(), $_GET['idPromocion']);
        break;
        case 'GET':
            if(isset($_GET['idPromocion']))
                Comentario::obtenerComentarios($database->getDB(), $_GET['idPromocion']);
        break;
        case 'PUT':
        break;
        case 'DELETE':
            Comentario::eliminarComentario($database->getDB(), $_GET['idPromocion'], $_GET['idComentario'], $_GET['idUsuario']);
        break;

    }
?>