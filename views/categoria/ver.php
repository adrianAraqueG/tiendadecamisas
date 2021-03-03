<?php if(isset($_GET['id'])): ?>
 <h1><?=$categoria->nombre?></h1>
 <?php if($productos->num_rows == 0):?>
    <h1>Categoria sin productos</h1>
    <?php else: ?>

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

    <?php endif; ?>
    
<?php else: ?>
 <h1>Categoria no encontrada</h1>
<?php endif; ?>