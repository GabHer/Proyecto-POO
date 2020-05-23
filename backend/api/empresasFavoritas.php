<?php

    header("Content-Type: application/json");
    include_once("../class/class-empresa.php");
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

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            
            $Empresa= new Empresa(
                $_POST['nameEnterprise'],
                $_POST['descriptionEnterprise'],
                $_POST['fundationDate'],
                $_POST['emailEnterprise'],
                $_POST['passwordEnterprise'],
                $_POST['postalCode'],
                $_POST['country'],
                $_POST['state'],
                $_POST['addressEnterprise'],
                $_POST['phoneNumberEnterprise'],
                $_POST['latitute'],
                $_POST['longitude'],
                $_POST['urlProfileImage'],
                $_POST['urlBanner']
            );

            echo $Empresa-> guardarEmpresaFav($database->getDB(), $_GET['idUsuario']);
        break;
        case 'GET':
            Empresa::obtenerEmpresasFav($database->getDB(), $_GET['idUsuario']);
        break;
        case 'PUT':
            
        break;
        case 'DELETE':       
        break;

    }
?>