<h1>Tu pedido ha sido confirmado</h1>
<p>
    Una vez que se refleje el pago se enviará el pedido a tu ciudad :)
</p>

</br>
<?php if(isset($pedido)): ?>
    <h2>Datos del pedido: </h2>
    Número del pedido: <?=$pedido->id?></br>
    Coste Total: $<?=$pedido->valor?></br>
    Productos: </br>
    
        <table>

            <tr>
                <td>Imagen</td>
                <td>Nombre</td>
                <td>Precio</td>
                <td>Unidades</td>
            </tr>
            <?php while($pro = $productos->fetch_object()): ?>
            <tr>
            
                <td>
                <?php if($pro->imagen != null): ?>
                    <img src="<?=base_url?>uploads/productImg/<?=$pro->imagen?>" class="img_carrito">
                <?php else: ?>
                    <img src="assets/img/camiseta.png<?=$pro->imagen?>" class="img_carrito">
                <?php endif; ?>
                </td>

                <td><?=$pro->nombre?></td>
                <td><?=$pro->precio?></td>
                <td><?=$pro->unidades?></td>
            
            </tr>
            <?php endwhile; ?>
        </table>
<?php endif; ?>
