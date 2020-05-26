<?php
    header("Content-Type: application/json");
    include_once("../class/class-calificacion.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $Calificacion= new Calificacion(
                $_POST['calificacion']
                
            );
            echo $Calificacion-> guardarCalificacion($database->getDB(), $_GET['idPromocion']);
        break;
        case 'GET':
            
        break;
        case 'PUT':
        break;
        case 'DELETE':
            //Eliminar            
        break;

    }
?>