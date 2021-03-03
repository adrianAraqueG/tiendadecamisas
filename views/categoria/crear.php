<h1>Crear categoria</h1>

<?php if(isset($_SESSION['saveCat'])):?>
    <?=$_SESSION['saveCat'] ?>
    <?php unset($_SESSION['saveCat']) ?>
<?php endif; ?>

<form action="<?=base_url?>categoria/save" method='POST'>
    <label for="nombre">Ingresa el nombre de la nueva categoria</label>
    <input type="text" name='nombre'>

    <input type="submit" value='Guardar'>

</form>