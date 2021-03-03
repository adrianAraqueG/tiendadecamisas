<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Tienda de camisetas</title>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	</head>
	<body>
		<div id='container'>
			<!-- CABECERA -->
			<header id='header'>
				<div id='logo'>
					<img src="assets/img/camiseta.png" alt='Camiseta Logo'>
					<a href="index.php">Tienda de Camisetas</a>
				</div>
			</header>





			<!-- MENÚ -->
			<nav id='menu'>
				<ul>
					<li>
						<a href="$">Inicio</a>
					</li>
					<li>
						<a href="$">Categoria 1</a>
					</li>
					<li>
						<a href="$">Categoria 2</a>
					</li>
					<li>
						<a href="$">Categoria 3</a>
					</li>
					<li>
						<a href="$">Categoria 4</a>
					</li>
				</ul>
			</nav>





			<!-- CONTENIDO -->
			<div id='content'>

				<!-- BARRA LATERAL -->
				<aside id='lateral'>
								<!--Login-->
					<div id='login' class= 'block-aside'>
						<form action='' method="POST">
							<label for='email'>Email</label>
							<input type="email" name="email">

							<label for='pass'>Contraseña</label>
							<input type="password" name="pass">

							<input type="submit" value='Enviar'>
						</form>
					</div>

					<a href="">Mis pedidos</a>
					<a href="">Gestionar pedidos</a>
					<a href="">Gestionar categorias</a>


								<!--Register-->
					<div id='register' class='block-aside'>
						<form method="POST" action="">
							<label for='nombre'>Nombre</label>
							<input type="text" name="nombre">

							<label for='apellido'>Apellido</label>
							<input type="text" name="apellido">

							<label for='email'>Email</label>
							<input type="email" name="email">

							<label for='pass'>Contraseña</label>
							<input type="password" name="pass">
						</form>
					</div>
				</aside>

			<!-- CONTENIDO CENTRAL -->
			<div id='central'>

				<div class='product'>
					<img src="assets/img/camiseta.png">
					<h2>Camiseta Azul Ancha</h2>
					<p>30 Euros</p>
					<a href="">Comprar</a>
				</div>

				<div class='product'>
					<img src="assets/img/camiseta.png">
					<h2>Camiseta Roja Ancha</h2>
					<p>30 Euros</p>
					<a href="">Comprar</a>
				</div>

				<div class='product'>
					<img src="assets/img/camiseta.png">
					<h2>Camiseta Verde Ancha</h2>
					<p>30 Euros</p>
					<a href="">Comprar</a>
				</div>

			</div>
			

			


			<!-- PIE DE PÁGINA -->
			<footer id='footer'>
				<p>Desarrollado por Carlos Araque &copy <?=date('Y')?></p>
			</footer>

		</div>
	</body>

</html>