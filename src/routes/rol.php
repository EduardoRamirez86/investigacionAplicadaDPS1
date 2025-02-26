<?php 

require_once "../models/Rol.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['IDrol'])) {
            echo json_encode(Rol::getWhere($_GET['IDrol']));
        } else {
            echo json_encode(Rol::getAll());
        }
        break;

    case 'POST':
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != NULL){
            if(Rol::insert($datos->nombreRol)){
                http_response_code(200);
                echo "Insersión realizada correctamente";
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;

    case 'PUT':
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != NULL){
            if(Rol::update($datos->IDrol, $datos->nombreRol)){
                http_response_code(200);
                echo "Actualización realizada correctamente";
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;

    case 'DELETE':
        if(isset($_GET['IDrol'])){
            if(Rol::delete($_GET['IDrol'])){
                http_response_code(200);
                echo "Rol eliminado correctamente";
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;

    default:
        break;
}

?>
