<?php include('view/header.php') ?>

<?php if($materias) { ?> <!-- Comprueba si hay materias para mostrar -->
    <section id="list" class="list">
        <header class="list__row list__header">
            <h1>
                Materias
            </h1>
        </header>

        <?php foreach ($materias as $materia) : ?> <!-- Itera a través de las materias -->
            <div class="list__row">
                <div class="list__item">
                    <p class="bold"><?= $materia['nombre_materia'] ?></p> <!-- Muestra el nombre de la materia -->
                </div>
                <div class="list__removeItem">
                    <form action="." method="post">
                        <input type="hidden" name="action" value="eliminar_materia"> <!-- Campo oculto para indicar el eliminar materia -->
                        <input type="hidden" name="materiaID" value="<?= $materia['materia_id']; ?>"> <!-- ID de la materia a eliminar -->
                        <button class="remove-button">❌</button> <!-- Botón para eliminar la materia -->
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php } else { ?> <!-- Se ejecuta si no hay materias para mostrar -->
    <p>No has añadido materias</p>
<?php } ?>

<section id="add" class="add">
    <h2>Añadir materia</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="añadir_materia"> <!-- Campo oculto para indicar el añadir materia -->
        <div class="add__inputs">
            <label>Nombre:</label>
            <input type="text" name="nombreMateria" maxlength="255" placeholder="Nombre" autofocus required> <!-- Campo para ingresar el nombre de la nueva materia -->
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Añadir</button> <!-- Botón para añadir la materia -->
        </div>
    </form>
</section>

<br>
<form action="." method="post">
    <button class="add-button bold" type="submit">Ver tareas</button> <!-- Botón para ver las tareas relacionadas con las materias -->
</form>

<?php include('view/footer.php') ?>