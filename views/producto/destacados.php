
<h1>Productos Destacados<h1><br>


<?php while($pro = $productos->fetch_object()): ?>
<div class='product'>
    <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>">
        <?php if($pro->imagen != null): ?>
        <img src="<?=base_url?>uploads/productImg/<?=$pro->imagen?>">
        <?php else: ?>
            <img src="assets/img/camiseta.png<?=$pro->imagen?>">
        <?php endif; ?>
    </a>
    <a href="<?=base_url?>producto/ver&id=<?=$pro->id?>">
        <h2><?=$pro->nombre?></h2>
    </a>
    <p><?=$pro->precio?> Euros</p>
    <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class='button'>Comprar</a>
</div>
<?php endwhile; ?>

