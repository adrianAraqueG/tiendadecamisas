<!-- VISTA RECICLADA, USADA PARA CREAR Y EDITAR PRODUCTOS -->


<?php if(isset($editar) && isset($pro) && is_object($pro)): ?>
    <h1>Editar producto: <?= $pro->nombre ?></h1>
    <?php $url_action = base_url."producto/save&id=".$pro->id ?>
<?php else:?>
    <h1>Añadir nuevo producto</h1>
    <?php $url_action = base_url."producto/save" ?>
<?php endif; ?>




<?php if(isset($_SESSION['savePro'])):?>
    <?= $_SESSION['savePro'] ?>
<?php endif; ?>

<?php $categoria = Utilities::showCategorias(); //$categorias = $categoria->fetch_object() ?>

<div class="form_container">
    <form action="<?=$url_action?>" enctype="multipart/form-data" method="POST">

        <label for="nombre">Nombre: </label>
        <input type="text" name='nombre' value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>">

        <label for="nombre">Categoria: </label>
        <select name="categoria">
            <?php while($cat = $categoria->fetch_object()): ?>
            <option value="<?=$cat->id?>">
                <?=$cat->nombre?>
            </option>
            <?php endwhile; ?>
        </select>

        <label for="descripcion">Descripción: </label>
        <textarea name="descripcion" id="" cols="30" rows="10"></textarea>

        <label for="precio">Precio: </label>
        <input type="text" name='precio' value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>">

        <label for="stock">Stock: </label>
        <input type="number" name='stock' step="0.01" value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''; ?>">

        <label for="img">Imagen: </label>
        <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)):?>
            <img src="<?=base_url?>uploads/productImg/<?=$pro->imagen?>">
        <?php endif; ?>
        <input type="file" name='img'>

        <input type="submit" value = "Guardar">
    
    </form>
</div>
<?php unset($_SESSION['savePro']) ?>