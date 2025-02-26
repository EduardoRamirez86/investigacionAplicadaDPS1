<?php
header("Content-Type: application/json");

if (!isset($_GET['model'])) {
    echo json_encode([
        "error" => "No se especificó el modelo. Utiliza el parámetro 'model' en la URL (usuario, libro, rol)."
    ]);
    exit;
}

$model = strtolower($_GET['model']);

switch ($model) {
    case 'usuario':
        require_once "routes/usuario.php";
        break;
    case 'libro':
        require_once "routes/libro.php";
        break;
    case 'rol':
        require_once "routes/rol.php";
        break;
    default:
        echo json_encode([
            "error" => "Modelo no soportado. Utiliza 'usuario', 'libro' o 'rol'."
        ]);
        break;
}
?>
