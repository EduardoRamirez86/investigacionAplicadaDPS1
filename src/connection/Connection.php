<?php

    class Connection extends Mysqli{
        function __construct(){
            parent::__construct('localhost', 'root', '', 'libreria');
            $this->set_charset('utf8');
            $this->connect_error == NULL ? 'Conexion existosa a la DB' : die('Error al conectarese a la base de datos');
        }
    }
    
/*

//configuracion para la img de mysql de docker

<?php
$host     = 'db';           // El servicio de MySQL se llama "db" según docker-compose
$dbname   = 'libreria';     // La base de datos se llama "Libreria"
$username = 'root';         // Usuario, en este ejemplo se usa root
$password = '123456';       // Contraseña establecida en docker-compose

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
*/ 
    
?>
 
