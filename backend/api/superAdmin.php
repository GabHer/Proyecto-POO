<?php
    header("Content-Type: application/json");
    include_once("../class/class-superAdmin.php");
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
            $superAdmin= new SuperAdmin(
                $_POST['email'],
                $_POST['password']
                
            );
            echo $superAdmin-> guardarSuperAdmin($database->getDB());
        break;
        case 'GET':
        break;
        case 'PUT':
            if(isset($_GET['idSuperAdmin'])){
            $superAdmin= new SuperAdmin(
                $_PUT['email'],
                $_PUT['password']
                
            );
            echo $superAdmin-> actualizarSuperAdmin($database->getDB(), $_GET['idSuperAdmin']);
        }
        break;
        case 'DELETE':
            //Eliminar            
        break;

    }
?>