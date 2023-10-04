<?php include('view/header.php') ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Tareas
        </h1>
        <form action="." method="get" id="list__header_select" class="list__header_select">
            <input type="hidden" name="action" value="ver_tareas"> <!-- Campo oculto para indicar la acción a realizar -->
            <select name="materiaID" required>
                <option value="0">Ver todas</option> <!-- Opción para ver todas las materias -->
                <?php foreach ($materias as $materia) : ?>
                    <?php if ($materiaID == $materia['materia_id']) { ?>
                        <option value="<?= $materia['materia_id'] ?>" selected> <!-- Opción seleccionada si coincide con $materiaID -->
                    <?php } else { ?>
                        <option value="<?= $materia['materia_id'] ?>">
                    <?php } ?>
                    <?= $materia['nombre_materia'] ?> <!-- Nombre de la materia -->
                    </option>
                <?php endforeach; ?>
            </select>
            <button class="add-button bold">Ver</button> <!-- Botón para ver las tareas de la materia -->
        </form>
    </header>
    <?php if($tareas) { ?> <!-- Comprueba si hay tareas para mostrar -->
        <?php foreach ($tareas as $tarea) : ?>
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= "{$tarea['nombre_materia']}" ?></p> <!-- Nombre de la materia de la tarea -->
                    <p><?= $tarea['descripcion']; ?></p> <!-- Descripción de la tarea -->
                </div>
                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="eliminar_tarea"> <!-- Campo oculto para indicar la acción de eliminar tarea -->
                        <input type="hidden" name="tareaID" value="<?= $tarea['tarea_id']; ?>"> <!-- ID de la tarea a eliminar -->
                        <button class="remove-button">❌</button> <!-- Botón para eliminar la tarea -->
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php } else { ?> <!-- Se ejecuta si no hay tareas para mostrar -->
        <br>
        <?php if ($materiaID) { ?> <!-- Comprueba si se ha seleccionado una materia -->
            <p>No has añadido tareas para esta materia</p>
        <?php } else { ?>
            <p>No has añadido tareas</p>
        <?php } ?>
        <br>
    <?php } ?>
</section>

<section id="add" class="add">
    <h2>Añadir tarea</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="añadir_tarea"> <!-- Campo oculto para indicar la acción de añadir tarea -->
        <div class="add__inputs">
            <label>materia:</label>
            <select name="materiaID" required>
                <option value="">Selecciona una materia</option>
                <?php foreach ($materias as $materia) : ?>
                    <option value="<?= $materia['materia_id']; ?>">
                        <?= $materia['nombre_materia']; ?> <!-- Nombre de la materia en el formulario de añadir tarea -->
                    </option>
                <?php endforeach; ?>
            </select>
            <label>descripcion:</label>
            <input type="text" name="descripcion" maxlength="255" placeholder="Descripción" required> <!-- Campo para la descripción de la tarea -->
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Añadir</button> <!-- Botón para añadir tarea -->
        </div>
    </form>
</section>
<br>
<form action=".?action=ver_materias" method="post">
    <button class="add-button bold" type="submit">Ver materias</button> <!-- Botón para ver las materias disponibles -->
</form>
<?php include('view/footer.php') ?>