<?php
require('model/database.php');
require('model/tarea_db.php');
require('model/materia_db.php');

$tareaID = filter_input(INPUT_POST, 'tareaID', FILTER_VALIDATE_INT); // Obtiene y filtra el ID de la tarea desde una solicitud POST
$descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING); // Obtiene y filtra la descripción de la tarea desde una solicitud POST
$nombreMateria = filter_input(INPUT_POST, 'nombreMateria', FILTER_SANITIZE_STRING); // Obtiene y filtra el nombre de la materia desde una solicitud POST

$materiaID = filter_input(INPUT_POST, 'materiaID', FILTER_VALIDATE_INT); // Obtiene y filtra el ID de la materia desde una solicitud POST
if (!$materiaID) {
    $materiaID = filter_input(INPUT_GET, 'materiaID', FILTER_VALIDATE_INT); // Si no se encuentra en POST, intenta obtenerlo de una solicitud GET
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING); // Obtiene y filtra la acción desde una solicitud POST
if (!$action) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); // Si no se encuentra en POST, intenta obtenerlo de una solicitud GET
    if (!$action) {
        $action = 'ver_tareas'; // Si no se especifica una acción, la acción predeterminada es "ver_tareas"
    }
}

switch($action) {
    case "ver_materias":
        $materias = get_materias(); // Obtiene la lista de materias desde la base de datos
        include('view/materia_view.php'); // Incluye la vista de materias
        break;
    case "añadir_materia":
        añadir_materia($nombreMateria); // Llama a la función para añadir una materia en la base de datos
        header("Location: .?action=ver_materias"); // Redirecciona a la vista de materias después de añadir una materia
        break;
    case "añadir_tarea":
        if ($materiaID && $descripcion) {
            añadir_tarea($materiaID, $descripcion); // Llama a la función para añadir una tarea en la base de datos
            header("Location: .?materiaID=$materiaID"); // Redirecciona a la vista de tareas de la materia después de añadir una tarea
        } else {
            $error = "Descripción de tarea no válida"; // Si falta la descripción o no es válida, muestra un error
            include('view/error.php'); // Incluye la vista de error
            exit();
        }
        break;
    case "eliminar_materia":
        if ($materiaID) {
            try {
                eliminar_materia($materiaID); // Llama a la función para eliminar una materia en la base de datos
            } catch (PDOException $e) {
                $error = "No puedes eliminar una materia si tiene tareas asignadas"; // Si no se puede eliminar debido a tareas relacionadas, muestra un error
                include('view/error.php'); // Incluye la vista de error
                exit();
            }
            header("Location: .?action=ver_materias"); // Redirecciona a la vista de materias después de eliminar una materia
        }
        break;
    case "eliminar_tarea":
        if ($tareaID) {
            eliminar_tarea($tareaID); // Llama a la función para eliminar una tarea en la base de datos
            header("Location: .?materiaID=$materiaID"); // Redirecciona a la vista de tareas de la materia después de eliminar una tarea
        } else {
            $error = "Falta el ID o no es válido"; // Si falta el ID o no es válido, muestra un error
            include('view/error.php'); // Incluye la vista de error
        }
        break;
    default:
        $nombreMateria = get_nombre_materia($materiaID); // Obtiene el nombre de la materia actual
        $materias = get_materias(); // Obtiene la lista de materias desde la base de datos
        $tareas = get_tarea_materia($materiaID); // Obtiene la lista de tareas de la materia actual desde la base de datos
        include('view/tarea_view.php'); // Incluye la vista de tareas
}
?>