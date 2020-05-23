<?php

    header("Content-Type: application/json");
    include_once("../class/class-empresa.php");
    require_once('../class/class-database.php');
    $database= new Database();
    session_start();
    $_POST = json_decode(file_get_contents('php://input'), true);
    $_PUT = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            if(!isset($_SESSION["token"]))
            echo '{"Mensaje":"Acceso no autorizado"}';
            if(!isset($_COOKIE["token"]))
                echo '{"Mensaje":"Acceso no autorizado"}';
            if($_SESSION["token"] != $_COOKIE["token"])
                echo '{"Mensaje":"Acceso no autorizado"}';
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

            echo $Empresa-> crearEmpresa($database->getDB());
        break;
        case 'GET':
            if(isset($_GET['idEmpresa'])){
                if(!isset($_SESSION["token"]))
                echo '{"Mensaje":"Acceso no autorizado"}';
                if(!isset($_COOKIE["token"]))
                    echo '{"Mensaje":"Acceso no autorizado"}';
                if($_SESSION["token"] != $_COOKIE["token"])
                    echo '{"Mensaje":"Acceso no autorizado"}';
                Empresa::obtenerEmpresa($database->getDB(), $_GET['idEmpresa']);
            }else{
                Empresa::obtenerEmpresas($database->getDB());
            }
        break;
        case 'PUT':
            if(!isset($_SESSION["token"]))
            echo '{"Mensaje":"Acceso no autorizado"}';
            if(!isset($_COOKIE["token"]))
                echo '{"Mensaje":"Acceso no autorizado"}';
            if($_SESSION["token"] != $_COOKIE["token"])
                echo '{"Mensaje":"Acceso no autorizado"}';
            if(isset($_GET['idEmpresa'])){
                $Empresa= new Empresa(
                    $_PUT['nameEnterprise'],
                    $_PUT['descriptionEnterprise'],
                    $_PUT['fundationDate'],
                    $_PUT['emailEnterprise'],
                    $_PUT['passwordEnterprise'],
                    $_PUT['postalCode'],
                    $_PUT['country'],
                    $_PUT['state'],
                    $_PUT['addressEnterprise'],
                    $_PUT['phoneNumberEnterprise'],
                    $_PUT['latitute'],
                    $_PUT['longitude'],
                    $_PUT['urlProfileImage'],
                    $_PUT['urlBanner']
                );

                echo $Empresa->actualizarEmpresa($database->getDB(),$_GET['idEmpresa']);
            }
            
        break;
        case 'DELETE':
            if(!isset($_SESSION["token"]))
            echo '{"Mensaje":"Acceso no autorizado"}';
            if(!isset($_COOKIE["token"]))
                echo '{"Mensaje":"Acceso no autorizado"}';
            if($_SESSION["token"] != $_COOKIE["token"])
                echo '{"Mensaje":"Acceso no autorizado"}';
            Empresa::eliminarEmpresa($database->getDB(),$_GET['idEmpresa']);              
        break;

    }
?>