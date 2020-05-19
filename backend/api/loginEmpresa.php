<?php
session_start();
    header("Content-Type: application/json");
    include_once("../class/class-empresa.php");
    require_once('../class/class-database.php');
    $database= new Database();
    $_POST = json_decode(file_get_contents('php://input'),true);
    switch($_SERVER['REQUEST_METHOD']){
        case 'POST':
            $Empresa = Empresa::verificarEmpresa($_POST['email'], $_POST['password'], $database->getDB());
            if($Empresa){
                $resultado =array(
                    "codigoResultado"=>1,
                    "mensaje"=>"Empresa autenticada",
                    "token"=>sha1(uniqid(rand(), true))
                );
                echo json_encode($resultado);
                $_SESSION["token"]= $resultado["token"];
                setcookie("token", $resultado["token"], time()+ (60*60*24*31), "/");
            }
            else{
                setcookie("token", "", time()-1, "/");
                setcookie("id", "", time()-1, "/");
                setcookie("latitute", "", time()-1, "/");
                setcookie("longitude", "", time()-1, "/");
                echo '{"codigoResultado":"0", "mensaje":"Email / Password Incorrectos"}';
            }
        break;
    }
?>