<?php 

require_once "../models/Usuario.php";

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        if(isset($_GET['IDusuario'])) {
            echo json_encode(Usuario::getWhere($_GET['IDusuario']));
        } else {
            echo json_encode(Usuario::getAll());
        }
        break;

    case 'POST':
        $datos = json_decode(file_get_contents('php://input'));
        if($datos != NULL){
            if(Usuario::insert($datos->nombreUsuario, $datos->apellidoUsuario, $datos->contrasennia, $datos->IDrol)){
                http_response_code(200);
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
            if(Usuario::update($datos->IDusuario, $datos->nombreUsuario, $datos->apellidoUsuario, $datos->contrasennia, $datos->IDrol)){
                http_response_code(200);
            } else {
                http_response_code(400);
            }
        } else {
            http_response_code(405);
        }
        break;

    case 'DELETE':
        if(isset($_GET['IDusuario'])){
            if(Usuario::delete($_GET['IDusuario'])){
                http_response_code(200);
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
