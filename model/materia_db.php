<?php

// Método para obtener todas las materias
function get_materias() {
    global $db;
    // Consulta SQL para obtener todas las materias ordenadas por su ID
    $query = 'SELECT * FROM materias ORDER BY materia_id';
    $statement = $db->prepare($query);
    $statement->execute();
    $materias = $statement->fetchAll();
    $statement->closeCursor();
    return $materias;
}

// Método para obtener el nombre de una materia por su ID
function get_nombre_materia($materiaID) {
    if (!$materiaID) {
        return "Todas las materias";
    }
    global $db;
    // Consulta SQL para obtener el nombre de una materia específica por su ID
    $query = 'SELECT * FROM materias WHERE materia_id = :materiaID';
    $statement = $db->prepare($query);
    $statement->bindValue(':materiaID', $materiaID);
    $statement->execute();
    $materia = $statement->fetch();
    $statement->closeCursor();
    $nombreMateria = $materia['nombre_materia'];
    return $nombreMateria;
}

// Método para eliminar una materia por su ID
function eliminar_materia($materiaID) {
    global $db;
    // Consulta SQL para eliminar una materia por su ID
    $query = 'DELETE FROM materias WHERE materia_id = :materiaID';
    $statement = $db->prepare($query);
    $statement->bindValue(':materiaID', $materiaID);
    $statement->execute();
    $statement->closeCursor();
}

// Método para añadir una nueva materia
function añadir_materia($nombreMateria) {
    global $db;
    // Consulta SQL para añadir una nueva materia
    $query = 'INSERT INTO materias (nombre_materia)
          VALUES
             (:nombre_materia)';
    $statement = $db->prepare($query);
    $statement->bindValue(':nombre_materia', $nombreMateria);
    $statement->execute();
    $statement->closeCursor();
}
?>