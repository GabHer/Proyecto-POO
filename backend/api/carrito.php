<?php
    header("Content-Type: application/json");
    include_once("../class/class-promocion.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $Promocion= new Promocion(
                $_POST['idEnterprise'],
                $_POST['products'],
                $_POST['selectCategory'],
                $_POST['priceProduct'],
                $_POST['Discount'],
                $_POST['discountPromo'],
                $_POST['startPromo'],
                $_POST['finishPromo'],
                $_POST['sucursal'],
                $_POST['urlProductPromoImage'],
                $_POST['descriptionPromo']
            );

            echo $Promocion-> añadirAlCarrito($database->getDB(), $_GET['idUsuario']);
        break;
        case 'GET':
            Promocion::obtenerPromocionesCarrito($database->getDB(), $_GET['idUsuario']);
        break;
        case 'PUT':
        break;
        case 'DELETE':
            if(isset($_GET['idUsuario']) and isset($_GET['idPromoCarrito'])){
                Promocion::eliminarPromoCarrito($database->getDB(),$_GET['idUsuario'],$_GET['idPromoCarrito']);
            }else{
                Promocion::eliminarTodasPromoCarrito($database->getDB(),$_GET['idUser']);}
        break;

    }
?>