<?php
$host = 'db';
$dbname = 'Libros_db';
$username = 'root';
$password = '123456';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ejemplo: Crear una tabla
    $sql = "CREATE TABLE IF NOT EXISTS libros (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(255) NOT NULL,
        autor VARCHAR(255) NOT NULL
    )";
    $conn->exec($sql);
    echo "Tabla 'libros' creada correctamente.";

    // Ejemplo: Insertar un libro
    $stmt = $conn->prepare("INSERT INTO libros (titulo, autor) VALUES (:titulo, :autor)");
    $stmt->execute([
        'titulo' => 'Cien años de soledad',
        'autor' => 'Gabriel García Márquez'
    ]);
    echo "Libro insertado correctamente.";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>