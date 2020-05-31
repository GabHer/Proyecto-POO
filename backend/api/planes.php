<?php
    header("Content-Type: application/json");
    include_once("../class/class-plan.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'), true);

    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $Plan= new Plan(
                $_POST['costo'],
                $_POST['duracion'],
                $_POST['descripcion']
            );
            echo $Plan-> guardarPlan($database->getDB());
        break;
        case 'GET':
            //Obtener
        break;
        case 'PUT':
        break;
        case 'DELETE':
            //Eliminar            
        break;

    }
?>