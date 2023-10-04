<!-- Vista de errores -->
<?php include('header.php') ?>
<h2>Error</h2>
<p><?php echo $error; ?></p>
<br>
<form action="." method="get">
    <button class="add-button bold" type="submit">Volver</button>
</form>
<?php include('footer.php') ?>