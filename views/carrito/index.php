<h1>Carrito de Compras</h1>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >=1 ): ?>

<table>
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
        <th>Eliminar</th>
    </tr>
    <?php 
    foreach($carrito as $indice => $elemento):
        $pro = $elemento['producto'];
    ?>
    <tr>
        <td>
            <?php if($pro->imagen != null): ?>
                <img src="<?=base_url?>uploads/productImg/<?=$pro->imagen?>" class="img_carrito">
            <?php else: ?>
                <img src="assets/img/camiseta.png<?=$pro->imagen?>" class="img_carrito">
            <?php endif; ?>
        </td>
        <td>
            <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>"><?=$pro->nombre?></a>
        </td>
        <td><?=$pro->precio?></td>
        <td>
            <?=$elemento['unidades']?>
            <div class="updown-unidades">
                <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class='button' >+</a>
                <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class='button' >-</a>
            </div>

        </td>
        <td><a href="<?=base_url?>carrito/remove&index=<?=$indice?>" class='button button-carrito button-red' >Quitar</a></td>
    </tr>
    <?php endforeach; ?>

</table>

<div class="delete-carrito">
    <a href="<?=base_url?>carrito/delete_all" class='button button-delete button-red' >Borrar carrito</a>
</div>

<?php $stats = Utilities::statsCarrito()?>
<div class="total-carrito">
    <h3>Precio Total: <?=$stats['total']?></h3>
    <a href="<?=base_url?>pedido/hacer" class='button button-pedido' >Hacer pedido</a>

</div>

<?php else: ?>

<p>El carrito está vació, añade productos :)</p>

<?php endif; ?>