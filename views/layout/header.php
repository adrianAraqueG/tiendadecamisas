<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Tienda de camisetas</title>
        <link rel="stylesheet" type="text/css" href="<?=base_url?>assets/css/styles.css">
    </head>
<body>
<!-- INICIO -->
<div id='container'>

<!-- CABECERA -->
<header id='header'>
    <div id='logo'>
        <img src="<?=base_url?>assets/img/camiseta.png" alt='Camiseta Logo'>
        <a href="index.php">Tienda de Camisetas</a>
    </div>
</header>



<!-- MENÚ -->
<?php $categorias = Utilities::showCategorias()?>
<nav id='menu'>
    <ul>
        <li>
            <a href="<?=base_url?>producto/index" >Inicio</a>
        </li>
        <?php while($cat = $categorias->fetch_object()): ?>
        <li>
            <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"> <?=$cat->nombre?> </a>
        </li>
        <?php endwhile; ?>
    </ul>
</nav>
