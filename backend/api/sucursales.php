<?php
    header("Content-Type: application/json");
    include_once("../class/class-sucursal.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            if(isset($_GET['idEmpresa'])){
            $Sucursal= new Sucursal(
                $_POST['nameSucursal'],
                $_POST['emailSucursal'],
                $_POST['addressSucursal'],
                $_POST['phoneSucursal'],
                $_POST['latitudeSucursal'],
                $_POST['longitudeSucursal'],
                $_POST['urlProfileImageSucursal']
            );
        }
            echo $Sucursal-> guardarSucursal($database->getDB(), $_GET['idEmpresa']);
        break;
        case 'GET':
            if(isset($_GET['idEmpresa']))
                Sucursal::obtenerSucursales($database->getDB(), $_GET['idEmpresa']);
            if(isset($_GET['idEnterprise']) && isset($_GET['idSucursal']))
                Sucursal::obtenerSucursal($database->getDB(), $_GET['idEnterprise'], $_GET['idSucursal']);
        break;
        case 'PUT':
        break;
        case 'DELETE':
            //Eliminar            
        break;

    }
?>