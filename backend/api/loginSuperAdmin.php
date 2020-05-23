<?php
session_start();
    header("Content-Type: application/json");
    include_once("../class/class-superAdmin.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $SuperAdmin = SuperAdmin::verificarSuperAdmin($_POST['email'], $_POST['password'], $database->getDB());
            if($SuperAdmin){
                $resultado =array(
                    "codigoResultado"=>1,
                    "mensaje"=>"SuperAdmin autenticado",
                    "token"=>sha1(uniqid(rand(), true))
                );
                echo json_encode($resultado);
                $_SESSION["token"]= $resultado["token"];
                setcookie("token", $resultado["token"], time()+ (60*60*24*31), "/");
            }
            else{
                setcookie("token", "", time()-1, "/");
                setcookie("id", "", time()-1, "/");
                echo '{"codigoResultado":"0", "mensaje":"Email / Password Incorrectos"}';
            }
        break;
    }
?>