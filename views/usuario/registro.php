<h1>Registrarse</h1>
    <form action="<?=base_url?>usuario/save" method='POST'>

        <!-- Recibir los datos del guardado de usuarios -->
        <?php if(isset($_SESSION['register']) && $_SESSION['register']=='complete'): ?>
            <strong class="alert_green">Registro completado correctamente :)</strong>
        <?php elseif(isset($_SESSION['register']) && $_SESSION['register']!='complete'):
            $error = $_SESSION['register'];
            echo $error;
        endif; ?>

        <label for='nombre'>Nombre</label>
        <input type="text" name="nombre">

        <label for='apellido'>Apellido</label>
        <input type="text" name="apellido">

        <label for='email'>Email</label>
        <input type="email" name="email">

        <label for='pass'>Contraseña</label>
        <input type="password" name="pass">

        <input type="submit" value='Enviar'>

    </form>

<!-- Borrar las sesiones -->
<?php Utilities::deleteSesion('register')?>