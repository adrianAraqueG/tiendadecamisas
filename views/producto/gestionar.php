<h1>Gestión de productos</h1>

<a href="<?=base_url?>producto/crear" class='button button-small'>Añadir Producto Nuevo</a>

<?php if(isset($_SESSION['delete'])): ?>
    <?=$_SESSION['delete'] ?>
<?php endif; ?>

<?php if(isset($_SESSION['saveEdit'])): ?>
    <?=$_SESSION['saveEdit'] ?>
<?php endif; ?>
<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Acciones</th>
    </tr>
    <?php while($pro = $productos->fetch_object()): ?>
        <tr>
            <td><?=$pro->id?></td>
            <td><?=$pro->nombre?></td>
            <td><?=$pro->precio?></td>
            <td><?=$pro->stock?></td>
            <td>
                <a href="<?=base_url?>/producto/edit&id=<?=$pro->id?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>/producto/delete&id=<?=$pro->id?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php //Destruir sesiones 
    unset($_SESSION['delete']);
    unset($_SESSION['saveEdit']);
?>