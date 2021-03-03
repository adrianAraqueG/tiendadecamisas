<?php if(isset($pro)): ?>
    <h1><?=$pro->nombre?></h1>

        <div id='detail-product'>
            <div class='image'>
            <?php if($pro->imagen != null): ?>
            <img src="<?=base_url?>uploads/productImg/<?=$pro->imagen?>">
            <?php else: ?>
                <img src="assets/img/camiseta.png<?=$pro->imagen?>">
            <?php endif; ?>
            </div>
        </div>

        <div class='data'>
            <p class='description'><?=$pro->descripcion?></p>
            <p class='price'><?=$pro->precio?> Euros</p>
            <a href="<?=base_url?>carrito/add&id=<?=$pro->id?>" class='button'>Comprar</a>
        </div>
        
<?php else:?>
    <h1>El producto no existe</h1>
<?php endif; ?>