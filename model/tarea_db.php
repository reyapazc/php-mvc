<?php

// Método para obtener las tareas de una materia
function get_tarea_materia($materiaID) {
    global $db;
    if ($materiaID) {
        // Consulta SQL para obtener las tareas de una materia específica
        $query = 'SELECT T.tarea_id, T.descripcion, M.nombre_materia FROM tareas T LEFT JOIN materias M ON T.materia_id = M.materia_id WHERE T.materia_id = :materiaID ORDER BY tarea_id';
    } else {
        // Consulta SQL para obtener todas las tareas de todas las materias
        $query = 'SELECT T.tarea_id, T.descripcion, M.nombre_materia FROM tareas T LEFT JOIN materias M ON T.materia_id = M.materia_id ORDER BY M.materia_id';
    }
    $statement = $db->prepare($query);
    if ($materiaID) {
        $statement->bindValue(':materiaID', $materiaID);
    }
    $statement->execute();
    $tareas = $statement->fetchAll();
    $statement->closeCursor();
    return $tareas;
}

// Método para eliminar una tarea
function eliminar_tarea($tareaID) {
    global $db;
    // Consulta SQL para eliminar una tarea por su ID
    $query = 'DELETE FROM tareas WHERE tarea_id = :IDtarea';
    $statement = $db->prepare($query);
    $statement->bindValue(':IDtarea', $tareaID);
    $statement->execute();
    $statement->closeCursor();
}

// Método para añadir una tarea
function añadir_tarea($materiaID, $descripcion) {
    global $db;
    // Consulta SQL para añadir una nueva tarea
    $query = 'INSERT INTO tareas (descripcion, materia_id)
          VALUES
             (:descr, :materia_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':descr', $descripcion);
    $statement->bindValue(':materia_id', $materiaID);
    $statement->execute();
    $statement->closeCursor();
}
?>