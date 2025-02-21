<?php
header("Content-Type: application/json");

// Simulación de una base de datos
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

// Endpoint para autenticación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_SERVER['REQUEST_URI'] === '/login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'] ?? '';
    $password = $data['password'] ?? '';

    if (isset($users[$username]) && $users[$username] === $password) {
        // Generar un token JWT (simulado)
        $token = base64_encode(json_encode(['username' => $username, 'exp' => time() + 3600]));
        echo json_encode(['token' => $token]);
    } else {
        http_response_code(401);
        echo json_encode(['error' => 'Invalid credentials']);
    }
    exit;
}

// Endpoint protegido
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/data') {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? '';

    if ($token) {
        $payload = json_decode(base64_decode($token), true);
        if ($payload && isset($payload['username']) && $payload['exp'] > time()) {
            echo json_encode(['data' => 'This is protected data for ' . $payload['username']]);
            exit;
        }
    }

    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

// Endpoint público
if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_SERVER['REQUEST_URI'] === '/public') {
    echo json_encode(['message' => 'This is public data']);
    exit;
}

// Si no se encuentra el endpoint
http_response_code(404);
echo json_encode(['error' => 'Not Found']);
?>