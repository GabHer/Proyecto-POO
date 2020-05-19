<?php
    header("Content-Type: application/json");
    include_once("../class/class-producto.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $Producto= new Producto(
                $_POST['nameProduct'],
                $_POST['priceProduct'],
                $_POST['descriptionProduct'],
                $_POST['urlProductImage']
            );
            echo $Producto-> guardarProducto($database->getDB(), $_GET['idEmpresa']);
        break;
        case 'GET':
            if(isset($_GET['idEmpresa']))
                Producto::obtenerProductos($database->getDB(), $_GET['idEmpresa']);
            if(isset($_GET['idEnterprise']) && isset($_GET['idProducto']))
                Producto::obtenerProducto($database->getDB(), $_GET['idEnterprise'], $_GET['idProducto']);
        break;
        case 'PUT':
        break;
        case 'DELETE':
            //Eliminar            
        break;

    }
?>