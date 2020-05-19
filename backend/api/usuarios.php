<?php

    header("Content-Type: application/json");
    include_once("../class/class-usuario.php");
    require_once('../class/class-database.php');
    $database= new Database();
    session_start();
    if(!isset($_SESSION["token"]))
        echo '{"Mensaje":"Acceso no autorizado"}';
    if(!isset($_COOKIE["token"]))
        echo '{"Mensaje":"Acceso no autorizado"}';
    if($_SESSION["token"] != $_COOKIE["token"])
        echo '{"Mensaje":"Acceso no autorizado"}';

    $_POST = json_decode(file_get_contents('php://input'), true);
    $_PUT = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $usuario= new Usuario(
                $_POST['name'],
                $_POST['lastName'],
                $_POST['birthday'],
                $_POST['gender'],
                $_POST['postal'],
                $_POST['country'],
                $_POST['state'],
                $_POST['address'],
                $_POST['phone'],
                $_POST['email'],
                $_POST['password'],
                $_POST['nameOwner'],
                $_POST['creditNumber'],
                $_POST['expirationDate'],
                $_POST['cvv'],
                $_POST['urlProfileImage']
            );

            echo $usuario-> crearUsuario($database->getDB());
        break;
        case 'GET':
            if(isset($_GET['idUsuario'])){
                Usuario::obtenerUsuario($database->getDB(), $_GET['idUsuario']);
            }else{
                Usuario::obtenerUsuarios($database->getDB());
            }
        break;
        case 'PUT':
            if(isset($_GET['idUsuario'])){
                $usuario= new Usuario(
                    $_PUT['name'],
                    $_PUT['lastName'],
                    $_PUT['birthday'],
                    $_PUT['gender'],
                    $_PUT['postal'],
                    $_PUT['country'],
                    $_PUT['state'],
                    $_PUT['address'],
                    $_PUT['phone'],
                    $_PUT['email'],
                    $_PUT['password'],
                    $_PUT['nameOwner'],
                    $_PUT['creditNumber'],
                    $_PUT['expirationDate'],
                    $_PUT['cvv'],
                    $_PUT['urlProfileImage']
                );

                echo $usuario->actualizarUsuario($database->getDB(),$_GET['idUsuario']);
            }
            
        break;
        case 'DELETE':
            Usuario::eliminarUsuario($database->getDB(),$_GET['idUsuario']);           
        break;

    }
?>