<h1>Detalles del pedido</h1>

<?php if(isset($_SESSION['admin'])): ?>
<h2>Cambiar estado del producto: </h2>
    
    <form action="<?=base_url?>pedido/estado" method="POST">

        <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
        <select name="estado">
            <option value="estado">Pendiente</option>
            <option value="preparation">En preparación</option>
            <option value="ready">Listo para enviar</option>
            <option value="sended">Enviado</option>
        </select>

        <input type="submit" value="Cambiar Estado">
    </form>
    </br>
<?php endif; ?>


<h2>Direccion de envío:</h2>
Provincia: <?=$pedido->provincia?></br>
Ciudad: $<?=$pedido->localidad?></br>
Dirección: $<?=$pedido->direccion?></br>

<h2>Datos del pedido: </h2>
Estado: <?=Utilities::showStatus($pedido->estado)?></br>
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

            <td>
                <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>"><?=$pro->nombre?></a>
            </td>
            <td><?=$pro->precio?></td>
            <td><?=$pro->unidades?></td>
        
        </tr>
        <?php endwhile; ?>
    </table>