<?php
header("Content-Type: application/json");

$servername = "db"; // Nombre del servicio en Docker
$username = "root";
$password = "123456";
$dbname = "Libros_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST' && $uri === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $user = $data['username'] ?? '';
    $pass = $data['password'] ?? '';

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($pass, $hash)) {
        $token = base64_encode(json_encode(["username" => $user, "exp" => time() + 3600]));
        echo json_encode(["token" => $token]);
    } else {
        http_response_code(401);
        echo json_encode(["error" => "Invalid credentials"]);
    }
    exit;
}

if ($method === 'GET' && $uri === 'data') {
    $headers = getallheaders();
    $token = $headers['Authorization'] ?? '';

    if ($token) {
        $payload = json_decode(base64_decode($token), true);
        if ($payload && isset($payload['username']) && $payload['exp'] > time()) {
            echo json_encode(["data" => "Protected data for " . $payload['username']]);
            exit;
        }
    }
    http_response_code(401);
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

if ($method === 'GET' && $uri === 'public') {
    echo json_encode(["message" => "This is public data"]);
    exit;
}

if ($method === 'GET' && $uri === '') {
    echo json_encode(["message" => "Welcome to the API"]);
    exit;
}


http_response_code(404);
echo json_encode(["error" => "Not Found"]);
