<?php 

require_once "../models/Libro.php";

    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':
            if(isset($_GET['ID'])) {
                echo json_encode(Libro::getWhere($_GET['ID']));
            } else {
                echo json_encode(Libro::getAll());
            }
            break;
        case 'POST':
                $datos = json_decode(file_get_contents('php://input'));
                if($datos != NULL){
                    if(Libro::insert($datos->nombreLibro, $datos->autor, $datos->editorial, $datos->edicion)){
                        http_response_code(200);
                        echo "Insersión realizada correctamente";
                    }
                    else {
                        http_response_code(400);
                    }
                } else {
                    http_response_code(405);
                }
            break;
        case 'PUT':
            $datos = json_decode(file_get_contents('php://input'));
            if($datos != NULL){
                if(Libro::update($datos->ID, $datos->nombreLibro, $datos->autor, $datos->editorial, $datos->edicion)){
                    http_response_code(200);
                    echo "Actualización realizada correctamente";
                }
                else {
                    http_response_code(400);
                }
            } else {
                http_response_code(405);
            }
            break;
        case 'DELETE':
            if(isset($_GET['ID'])){
                if(Libro::delete($_GET['ID'])){
                    http_response_code(200);
                    echo "Libro eliminado correctamente";
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