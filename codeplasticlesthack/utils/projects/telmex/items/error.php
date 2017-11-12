<html xml:lang="es" xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 
		<title>Telefonos de Mexico Telmex</title>
		<meta content="es" http-equiv="Content-Language" />
		<meta content="Telmex" name="Author" />
		<meta content="Telefonos de MÃÂ©xico Telmex" name="Description" />
		<link media="all" href="css/error.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
<?php
	$error=$_REQUEST['error'];
	if($error==1){
?>
	<div id="error">
		<div id="left">
			<h1>error</h1>
			<h2>telmex<h2>
		</div>
		<div id="right">
			<h2>:: el usuario no existe</h2>
			<p>
				Si el problema persiste, comuniquese con el administrador. <br />
				Telefonos de México TELMEX
			</p>
		</div>
	<div>
<?php
	}
	else{
?>
	<div id="error">
		<div id="left">
			<h1>error</h1>
			<h2>telmex<h2>
		</div>
		<div id="right">
			<h2>:: Acceso Denegado</h2>
			<p>
				Usted no tiene permisos para entrar. Su Ip se guardo en la base de datos para futuras consultas. <br />
				Telefonos de México TELMEX
			</p>
		</div>
	<div>
<?php
	}
?>			
	</body>
</html> 
<?php
	die("");
?>
