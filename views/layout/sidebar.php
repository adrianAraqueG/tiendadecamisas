<!-- CONTENIDO -->
<div id='content'>

<!-- BARRA LATERAL -->
<aside id='lateral'>

    <?php if(Utilities::isLogin() == true): ?>
    <?php $stats = Utilities::statsCarrito(); //var_dump($stats); ?>
    <div id="carrito" class="block-aside">
        <h3>Mi carrito</h3>
        <ul>
            <li>Productos (<?=$stats['count']?>)</li>
            <li>Total: $<?=$stats['total']?></li>
            <li><a href="<?=base_url.'carrito/index'?>">Ver carrito</a></li>
        </ul>
    </div>
    <?php endif; ?>


                <!--Login-->
    <?php if(isset($_SESSION['error_login'])){
            echo "<strong class='alert_red'>".$_SESSION['error_login']."</strong>";
            unset($_SESSION['error_login']);
        }
    ?>
    <?php if(!isset($_SESSION['identity'])): ?>
        
    <h3>Ingresa!</h3>
    <div id='login' class= 'block-aside'>
        <form action="<?=base_url?>usuario/login" method="POST">
            <label for='email'>Email</label>
            <input type="email" name="email">

            <label for='pass'>Contraseña</label>
            <input type="password" name="pass">

            <input type="submit" value='Enviar'>
        </form>
        <ul>
        <li><a href="<?=base_url.'usuario/registro'?>">Registrate</a></li>
        </ul>
    </div>
    <?php else: ?>
    <ul>
        <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
    
        <li><a href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>

        <?php if(isset($_SESSION['admin'])): ?>
            <li><a href="<?=base_url?>producto/gestionar">Gestionar productos</a></li>
            <li><a href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
            <li><a href="<?=base_url?>pedido/gestionar">Gestionar pedidos</a></li>
        <?php endif; ?>

        <li><a href="<?=base_url?>usuario/exit">Cerrar sesión</a></li>

    </ul>
    <?php endif; ?>
</aside>

<!-- CONTENIDO CENTRAL -->
<div id='central'>