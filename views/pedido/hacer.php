<?php if(Utilities::isLogin()): ?>
    <h1>Hacer pedido</h1>
    <h3>Dirección para el envío:</h3>
    <form action="<?=base_url?>pedido/add" method="POST">
        <label for="provincia">Provincia</label>
        <input type="text" name="provincia" required>

        <label for="localidad">Ciudad</label>
        <input type="text" name="localidad" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Confirmar pedido">
    </form>
    </br>
    <a href="<?=base_url?>carrito/index">Ver los productos</a>


    <?php  
        if(isset($_SESSION['savePed'])){
            echo $_SESSION['savePed'];
            unset($_SESSION['savePed']);
        }
    ?>
<?php else: ?>
    <h1>Error de sesión</h1>
    <h2>Necesitas estár identificado para ver tus pedidos :)</h2>
<?php endif; ?>