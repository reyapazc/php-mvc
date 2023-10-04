<?php
    // Conexión a la base de datos
    $dsn = 'mysql:host=localhost;dbname=lista_tareas';
    $username = 'root';

    // Manejo de errores
    try {
        $db = new PDO($dsn, $username);
    } catch (PDOException $e) {
        $error = "Error de base de datos: ";
        $error .= $e->getMessage();
        include('view/error.php');
        exit();
    }